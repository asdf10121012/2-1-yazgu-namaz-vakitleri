jQuery(document).ready(function($) {
    // Türkiye illeri (tam liste, kaynak: genel bilinen)
    const cities = {
        "Adana": 955, "Adıyaman": 956, "Afyonkarahisar": 957, "Ağrı": 958, "Amasya": 959,
        "Ankara": 960, "Antalya": 961, "Artvin": 962, "Aydın": 963, "Balıkesir": 964,
        "Bilecik": 965, "Bingöl": 966, "Bitlis": 967, "Bolu": 968, "Burdur": 969,
        "Bursa": 970, "Çanakkale": 971, "Çankırı": 972, "Çorum": 973, "Denizli": 974,
        "Diyarbakır": 975, "Edirne": 976, "Elazığ": 977, "Erzincan": 978, "Erzurum": 979,
        "Eskişehir": 980, "Gaziantep": 981, "Giresun": 982, "Gümüşhane": 983, "Hakkari": 984,
        "Hatay": 985, "Isparta": 986, "Mersin": 987, "İstanbul": 988, "İzmir": 989,
        "Kars": 990, "Kastamonu": 991, "Kayseri": 992, "Kırklareli": 993, "Kırşehir": 994,
        "Kocaeli": 995, "Konya": 996, "Kütahya": 997, "Malatya": 998, "Manisa": 999,
        "Kahramanmaraş": 1000, "Mardin": 1001, "Muğla": 1002, "Muş": 1003, "Nevşehir": 1004,
        "Niğde": 1005, "Ordu": 1006, "Rize": 1007, "Sakarya": 1008, "Samsun": 1009,
        "Siirt": 1010, "Sinop": 1011, "Sivas": 1012, "Tekirdağ": 1013, "Tokat": 1014,
        "Trabzon": 1015, "Tunceli": 1016, "Şanlıurfa": 1017, "Uşak": 1018, "Van": 1019,
        "Yozgat": 1020, "Zonguldak": 1021, "Aksaray": 1022, "Bayburt": 1023, "Karaman": 1024,
        "Kırıkkale": 1025, "Batman": 1026, "Şırnak": 1027, "Bartın": 1028, "Ardahan": 1029,
        "Iğdır": 1030, "Yalova": 1031, "Karabük": 1032, "Kilis": 1033, "Osmaniye": 1034,
        "Düzce": 1035
    };

    // Ayarlar butonu ekle (sağ üst köşe)
    $('.masjidal-prayer-times').prepend(`
        <div style="text-align:right;margin-bottom:10px;">
            <button id="namaz-settings-btn" style="background:#2c3e50;color:white;border:none;padding:8px 12px;border-radius:5px;cursor:pointer;">⚙️ Ayarlar</button>
        </div>
    `);

    // Modal HTML ekle
    $('body').append(`
        <div id="namaz-location-modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;">
            <div style="background:white;margin:10% auto;padding:20px;width:300px;border-radius:10px;">
                <h3>Yer Seçimi</h3>
                <select id="city-select"><option value="">Şehir seçiniz</option></select><br><br>
                <select id="district-select"><option value="">İlçe seçiniz</option></select><br><br>
                <button id="save-location" style="background:#27ae60;color:white;border:none;padding:10px;width:100%;">Kaydet</button>
                <button id="close-modal" style="margin-top:10px;background:#e74c3c;color:white;border:none;padding:8px;width:100%;">Kapat</button>
            </div>
        </div>
    `);

    // Illeri doldur
    Object.keys(cities).sort().forEach(city => {
        $('#city-select').append(`<option value="${cities[city]}">${city}</option>`);
    });

    // LocalStorage'dan önceki seçimi yükle
    let selectedCityId = localStorage.getItem('namazCityId') || '';
    let selectedDistrictId = localStorage.getItem('namazDistrictId') || '';
    if (selectedCityId) $('#city-select').val(selectedCityId);
    if (selectedDistrictId) loadDistricts(selectedCityId, selectedDistrictId);

    // Şehir değişince ilçeleri yükle
    $('#city-select').on('change', function() {
        let cityId = $(this).val();
        if (cityId) loadDistricts(cityId);
    });

    function loadDistricts(cityId, preselect = '') {
        $.getJSON(`https://aladhan.com/prayer-times-config/cities?country=TR&state=${cityId}`, function(data) {
            $('#district-select').empty().append('<option value="">İlçe seçiniz</option>');
            data.forEach(d => {
                $('#district-select').append(`<option value="${d.id}">${d.name}</option>`);
            });
            if (preselect) $('#district-select').val(preselect);
        });
    }

    // Ayarlar butonu
    $('#namaz-settings-btn').on('click', function() {
        $('#namaz-location-modal').show();
    });

    $('#close-modal').on('click', function() {
        $('#namaz-location-modal').hide();
    });

    // Kaydet ve vakitleri yükle
    $('#save-location').on('click', function() {
        let cityId = $('#city-select').val();
        let districtId = $('#district-select').val();
        if (!districtId) {
            alert('Lütfen ilçe seçiniz!');
            return;
        }
        localStorage.setItem('namazCityId', cityId);
        localStorage.setItem('namazDistrictId', districtId);
        $('#namaz-location-modal').hide();
        loadPrayerTimes(districtId);
    });

    // Vakitleri yükle (Aladhan API - Diyanet method=13)
    function loadPrayerTimes(locationId) {
        let today = new Date().toISOString().slice(0,10);
        $.getJSON(`https://api.aladhan.com/v1/timingsByCity/${today}?cityId=${locationId}&country=Turkey&method=13`, function(data) {
            if (data.code === 200) {
                let timings = data.data.timings;
                // Mevcut tabloyu güncelle (örnek selector'lar - senin temana göre uyarla)
                $('.fajr-time').text(timings.Fajr);
                $('.sunrise-time').text(timings.Sunrise);
                $('.dhuhr-time').text(timings.Dhuhr);
                $('.asr-time').text(timings.Asr);
                $('.maghrib-time').text(timings.Maghrib);
                $('.isha-time').text(timings.Isha);
                // Eğer iqamah varsa onları da güncelle veya gizle
            }
        });
    }

    // Sayfa yüklendiğinde önceki seçimi uygula
    if (selectedDistrictId) loadPrayerTimes(selectedDistrictId);
});