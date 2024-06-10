    function navigateToPage() {
        var select = document.getElementById("pageSelector");
        var url = select.value;
        if (url) {
            window.location.href = url;
        }
    }

    function ConfirmDelete() {
      if (confirm('Ця дія приведе до видалення з бази даних. Ви впевнені?')) {
        return true;
      } else {
        return false;
      }
    }