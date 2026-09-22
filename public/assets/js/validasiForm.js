function setError(idInput, idError, pesan){

    document.getElementById(idError).innerText = pesan;

    const el = document.getElementById(idInput);

    if (el.type === 'file') {

        el.style.border = '2px solid #e63946';

    }

    else {

        el.classList.add("input-error");

    }

}

function clearError(){

    document.querySelectorAll(".error-text")
    .forEach(e => e.innerText = "");

    document.querySelectorAll("input")
    .forEach(i => i.classList.remove("input-error"));

    document.querySelectorAll('input[type="file"]')
    .forEach(i => i.style.border = '');

}

function validateForm(){

    clearError();

    let valid = true;

    let nomor =
    document.getElementById("nomor")
    .value.trim();

    let judul =
    document.getElementById("judul")
    .value.trim();

    let tanggal =
    document.getElementById("tanggal_rilis")
    .value;

    let link =
    document.getElementById("link")
    .value.trim();

    if(nomor === ""){

        setError(
            "nomor",
            "errNomor",
            "Nomor tidak boleh kosong"
        );

        valid = false;

    }

    else if(!/^[0-9]+$/.test(nomor)){

        setError(
            "nomor",
            "errNomor",
            "Masukkan angka saja"
        );

        valid = false;

    }

    if(judul === ""){

        setError(
            "judul",
            "errJudul",
            "Judul tidak boleh kosong"
        );

        valid = false;

    }

    if(tanggal === ""){

        setError(
            "tanggal_rilis",
            "errTanggal",
            "Tanggal wajib diisi"
        );

        valid = false;

    }

    if(link === ""){

        setError(
            "link",
            "errLink",
            "Link wajib diisi"
        );

        valid = false;

    }

    const cover =
    document.getElementById('cover');

    if (cover.files.length === 0) {

        setError(
            'cover',
            'errCover',
            'Cover wajib diunggah'
        );

        valid = false;

    }

    else {

        const file = cover.files[0];

        const allowedTypes = [

            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/webp'

        ];

        if (!allowedTypes.includes(file.type)) {

            setError(
                'cover',
                'errCover',
                'Hanya file JPG/PNG/WEBP'
            );

            valid = false;

        }

        else if (file.size > 2 * 1024 * 1024) {

            setError(
                'cover',
                'errCover',
                'Ukuran file maksimal 2MB'
            );

            valid = false;

        }

    }

    return valid;

}