<script>
    const chooseFile = document.getElementById("photo-file");
    const imgPreview = document.getElementById("image-preview");

    chooseFile.addEventListener("change", function () {
        getImgData();
    });

    function getImgData() {
        const file = chooseFile.files[0];
        if (file) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.addEventListener("load", function () {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + this.result + '" class="img-thumbnail" alt="Imagine de previzualizare">';
            });
        }
    }
</script>
