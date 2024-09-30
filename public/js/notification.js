// ?todo
document.querySelectorAll(".mark-as-read-form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const notificationAlert = this.closest(".notification-alert");

        notificationAlert.classList.add("animate__fadeOutRight");

        setTimeout(() => {
            form.submit();
        }, 500);
    });
});

// ?todo change icon and text when file is uploaded
function updateUploadLabel() {
    var fileInput = document.getElementById("excel-file");
    var uploadLabel = document.getElementById("upload-label");
    var fileName = fileInput.files[0].name;

    uploadLabel.innerHTML = `<i class="fas fa-check-circle" style="color: green;"></i> <span>${fileName}</span>`;
}
