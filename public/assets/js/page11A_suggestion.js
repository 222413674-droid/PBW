function showHint(str) {

    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            // Mengubah JSON dari server menjadi array JavaScript
            var data = JSON.parse(this.responseText);

            var hasil = "";

            // Mengambil judul dari setiap data
            for (var i = 0; i < data.length; i++) {

                if (i > 0) {
                    hasil += ", ";
                }

                hasil += data[i].judul;
            }

            // Menampilkan hasil sebagai string biasa
            document.getElementById("txtHint").innerHTML = hasil;
        }
    };

    xhttp.open(
        "GET",
        "page11A_gethint.php?keyword=" + encodeURIComponent(str),
        true
    );

    xhttp.send();
}