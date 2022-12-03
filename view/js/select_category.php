    <script>
        function show_cfm() {
            var cfm = confirm("Bạn có chắc chắn muốn đăng bài không?");
            if (cfm) {
                return true;
            } else {
                return false;
            }
        }
        mobiscroll.setOptions({
            locale: mobiscroll.localeEn,
            theme: 'ios',
        });

        mobiscroll.select('#categories-mul-select', {
            inputElement: document.getElementById('categories-input'),
        });
    </script>