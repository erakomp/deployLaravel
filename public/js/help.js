function tgl(event) {
    const waktu = document.getElementsByClassName("waktu");
    const awal = waktu[0]
    const akhir = waktu[1]
    var date = new Date($(awal).val());
    var date2 = new Date($(akhir).val());
    var day1 = date.getDate();
    var month1 = date.getMonth() + 1;
    var year1 = date.getFullYear();
    var day2 = date2.getDate();
    var month2 = date2.getMonth() + 1;
    var year2 = date2.getFullYear();
    dAwal = [month1, day1, year1].join('')
    dAkhir = [month2, day2, year2].join('')
    if (parseInt(dAwal) > parseInt(dAkhir)) {
        event.preventDefault();
        alert(`Tanggal tidak boleh mundur`);
    }
}