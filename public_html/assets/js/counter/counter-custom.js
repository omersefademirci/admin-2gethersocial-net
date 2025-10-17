// Comma counter
(function () {
    const counters = document.querySelectorAll(".counter");
    const speed = 70;

    counters.forEach((counter) => {
        const updateCount = () => {
            const target = parseInt(counter.getAttribute("data-target"));
            const count = parseInt(counter.innerText.replace(/\./g, "").replace(/,/g, "")); // Remove commas and dots

            // Ensure increment is at least 1
            const increment = Math.max(Math.trunc(target / speed), 1);

            if (count < target) {
                let updatedCount = count + increment;

                // Ensure updatedCount does not exceed target
                if (updatedCount > target) {
                    updatedCount = target;
                }

                // Format the number with tr-TR (Turkish) locale
                updatedCount = updatedCount.toLocaleString("tr-TR");

                counter.innerText = updatedCount;
                setTimeout(updateCount, 20);
            } else {
                // Update counter.innerText with formatted target value
                counter.innerText = target.toLocaleString("tr-TR");
            }
        };

        updateCount();
    });
})();
