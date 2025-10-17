<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Restriction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class BrandUserController extends Controller
{
    public function index(): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        $users = User::query()
            ->where('user_type', 'brand')
            ->with(['restrictions.brand:id,name'])
            ->orderBy('name')
            ->get()
            ->map(function (User $user) {
                $brands = $user->restrictions
                    ->filter(function ($restriction) {
                        return $restriction->brand !== null;
                    })
                    ->sortBy(function ($restriction) {
                        return mb_strtolower($restriction->brand->name ?? '');
                    })
                    ->values()
                    ->map(function ($restriction) {
                        return [
                            'brand_id' => $restriction->brand->id,
                            'brand_name' => $restriction->brand->name,
                        ];
                    })
                    ->values();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'brands' => $brands,
                ];
            })
            ->values();

        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_user_forbidden_message'),
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'registration_key' => ['required', 'string', 'max:255'],
        ]);

        $validKey = config('services.registration.key', 'H4m/C0q3l3q%Dex');

        if ($validated['registration_key'] !== $validKey) {
            return response()->json([
                'message' => __('custom.invalid_registration_key'),
                'errors' => [
                    'registration_key' => [__('custom.invalid_registration_key')],
                ],
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'user_type' => 'brand',
            ]);
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => __('custom.brand_user_fail_message'),
            ], 500);
        }

        return response()->json([
            'message' => __('custom.brand_user_success_message'),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    public function assign(Request $request): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        $validated = $request->validate([
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'user_ids' => ['required', 'array', 'min:1'],
            'user_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $brandUserIds = User::query()
            ->whereIn('id', $validated['user_ids'])
            ->where('user_type', 'brand')
            ->pluck('id')
            ->all();

        if (count($brandUserIds) !== count($validated['user_ids'])) {
            return response()->json([
                'message' => __('custom.brand_member_invalid_user_message'),
                'errors' => [
                    'user_ids' => [__('custom.brand_member_invalid_user_message')],
                ],
            ], 422);
        }

        $createdCount = 0;

        foreach ($brandUserIds as $userId) {
            $restriction = Restriction::firstOrCreate([
                'brand_id' => $validated['brand_id'],
                'user_id' => $userId,
            ]);

            if ($restriction->wasRecentlyCreated) {
                $createdCount++;
            }
        }

        return response()->json([
            'message' => __('custom.brand_member_success_message'),
            'created' => $createdCount,
        ]);
    }

    public function members(Brand $brand): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        $members = Restriction::query()
            ->where('brand_id', $brand->id)
            ->whereHas('user', function ($query) {
                $query->where('user_type', 'brand');
            })
            ->with(['user:id,name,email,user_type'])
            ->get()
            ->filter(function ($restriction) {
                return $restriction->user !== null;
            })
            ->sortBy(function ($restriction) {
                return mb_strtolower($restriction->user->name ?? '');
            })
            ->values()
            ->map(function ($restriction) {
                return [
                    'user_id' => $restriction->user->id,
                    'name' => $restriction->user->name,
                    'email' => $restriction->user->email,
                ];
            });

        return response()->json($members);
    }

    public function allMembers(): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        $members = User::query()
            ->where('user_type', 'brand')
            ->with(['restrictions.brand:id,name'])
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                $brands = $user->restrictions
                    ->filter(function ($restriction) {
                        return $restriction->brand !== null;
                    })
                    ->sortBy(function ($restriction) {
                        return mb_strtolower($restriction->brand->name ?? '');
                    })
                    ->values()
                    ->map(function ($restriction) {
                        return [
                            'brand_id' => $restriction->brand->id,
                            'brand_name' => $restriction->brand->name,
                        ];
                    })
                    ->values();

                return [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'brands' => $brands,
                ];
            })
            ->values();

        return response()->json($members);
    }

    public function destroyUser(User $user): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        if ($user->user_type !== 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_invalid_user_message'),
            ], 422);
        }

        try {
            DB::transaction(function () use ($user) {
                $user->restrictions()->delete();
                $user->delete();
            });
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'message' => __('custom.brand_user_delete_fail_message'),
            ], 500);
        }

        return response()->json([
            'message' => __('custom.brand_user_deleted_message'),
        ]);
    }

    public function destroy(Brand $brand, User $user): JsonResponse
    {
        $currentUser = Auth::user();

        if ($currentUser && $currentUser->user_type === 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_forbidden_message'),
            ], 403);
        }

        if ($user->user_type !== 'brand') {
            return response()->json([
                'message' => __('custom.brand_member_invalid_user_message'),
            ], 422);
        }

        $restriction = Restriction::query()
            ->where('brand_id', $brand->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$restriction) {
            return response()->json([
                'message' => __('custom.brand_member_no_members_message'),
            ], 404);
        }

        $restriction->delete();

        return response()->json([
            'message' => __('custom.brand_member_removed_message'),
        ]);
    }
}
