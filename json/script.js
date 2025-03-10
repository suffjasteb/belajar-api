// object jadi json

// const mahasiswa = {
//     nama : "Sahfwan junindra",
//     nrp: "028329398382",
//     email: "shafwanjunindra@gmail.com"
// }

// console.log(JSON.stringify(mahasiswa))

// json jadi Object 
// pakai ajax
// let xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function() {
//     // kalo ajax nya udah ready
//     if (xhr.readyState = 4 && xhr.status == 200) {
//         let mahasiswa = JSON.parse(this.responseText);
//         console.log(mahasiswa);
//     }
// }

// xhr.open('GET', 'coba.json', true)
// xhr.send();


// pakai jquey
// $.getJSON('coba.json', function(data) {
//     console.log(data);
// })

// coba pakai fetch
fetch('coba.json') // Mengirimkan permintaan GET ke file coba.json.
.then(response => {
    // kalo respon nya not 200 throw error
    if (!response.ok) {
        throw new Error("Network Response was not ok")
    } return response.json(); // Mengkonversi response menjadi JSON
}).then(data => { //  Mengambil data hasil konversi JSON dan menjalankan logika lebih lanjut.
     // Menampilkan data yang diterima
    console.log(data);
}).catch(error => {
    // menangani error
    console.error(error); //Menangani jika terjadi kesalahan pada permintaan atau konversi data.
})