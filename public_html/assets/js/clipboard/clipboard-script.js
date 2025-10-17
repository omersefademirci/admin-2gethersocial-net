(function () {
    "use strict";
    var clipboard = new ClipboardJS(".btn-clipboard");

    clipboard.on("success", function (e) {
      // Butonu güncelleme
      var button = e.trigger; // Tıklanan butonu al

      if (button.classList.contains('btn-primary')) {
        button.classList.remove('btn-primary');
        button.classList.add('btn-success');
      }

      // Eğer buton içinde bir <i> ikonu varsa, onu değiştir
      var icon = button.querySelector('i');
      if (icon) {
        icon.className = 'fas fa-check'; // Font Awesome 'check' ikonuna geçiş
      }

      e.clearSelection();
    });

    clipboard.on("error", function (e) {});

    var clipboardCut = new ClipboardJS(".btn-clipboard-cut");

    clipboardCut.on("success", function (e) {
      // Butonu güncelleme
      var button = e.trigger; // Tıklanan butonu al

      if (button.classList.contains('btn-primary')) {
        button.classList.remove('btn-primary');
        button.classList.add('btn-success');
      }

      // Eğer buton içinde bir <i> ikonu varsa, onu değiştir
      var icon = button.querySelector('i');
      if (icon) {
        icon.className = 'fas fa-check'; // Font Awesome 'check' ikonuna geçiş
      }

      e.clearSelection();
    });

    clipboardCut.on("error", function (e) {});
  })();
