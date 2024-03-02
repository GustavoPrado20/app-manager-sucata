document.addEventListener("DOMContentLoaded", function() {
    var rows = document.querySelectorAll("li[data-href]");

    rows.forEach(function(row) {
      row.addEventListener("click", function() {
        window.location.href = this.dataset.href;
      });
    });
});
