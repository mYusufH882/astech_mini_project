$(document).ready(function () {
    var SpeechRecognition = window.webkitSpeechRecognition
    var recognition = new SpeechRecognition()

    var result = $("#text");
    var record = $("#microphone");
    var typeSelect = $("#type");
    var categorySelect = $("#category");
    var dateInput = $("#transaction_date");
    var yourVoice = $("#result");

    function prepareRecord() {
        recognition.continuous = true
        recognition.interimResults = true;
        recognition.lang = 'en-US';

        recognition.onstart = function () {
            result.text("Voice Recognition is On")
        }

        recognition.onspeechend = function () {
            result.text("No Activity")
        }

        recognition.onerror = function () {
            result.text("Try Again")
        }
    }

    function getTypeCategories(type) {
        $.ajax({
            url: '/categories/' + type,
            type: "GET",
            data: { "_token": "{{ csrf_token() }}" },
            dataType: "json",
            success: function (data) {
                if (data) {
                    categorySelect.empty();
                    // categorySelect.append("<option hidden>Choose Categories</option>");
                    $.each(data, function (key, category) {
                        $("select[name='category_id']").append("<option value=" + category.id + ">" + category.category_name + "</option>");
                    });
                } else {
                    categorySelect.empty();
                }
            }
        });
    }

    function getCategories(tp) {
        $.ajax({
            url: '/categories/' + type,
            type: "GET",
            data: { "_token": "{{ csrf_token() }}" },
            dataType: "json",
            success: function (data) {
                if (data) {
                    categorySelect.empty();
                    // categorySelect.append("<option hidden>Choose Categories</option>");
                    $.each(data, function (key, category) {
                        $("select[name='category_id']").append("<option value=" + category.id + ">" + category.category_name + "</option>");
                    });

                    if (tp.includes(category.category_name)) {
                        categorySelect.val(category.id);
                    }
                } else {
                    categorySelect.empty();
                }
            }
        });
    }

    function voiceAmount(tp) {
        const parsedNumber = parseInt(tp);
        if (!isNaN(parsedNumber)) {
            $("#amount").val(parsedNumber);
        } else {
            $("#amount").val("Tidak ada angka terdeteksi");
        }
    }

    function voiceTypeCategories(tp) {
        if (tp.includes("income")) {
            typeSelect.val('1');
            var typeId = typeSelect.val();
            if (typeId) {
                getTypeCategories(typeId);
            } else {
                categorySelect.empty();
            }
        } else if (tp.includes("expense")) {
            typeSelect.val('2');
            var typeId = typeSelect.val();
            if (typeId) {
                getTypeCategories(typeId);
            } else {
                categorySelect.empty();
            }
        }
    }

    prepareRecord();

    recognition.onresult = function (ev) {
        var current = ev.resultIndex;
        var transcript = ev.results[current][0].transcript;

        voiceTypeCategories(transcript);
        voiceAmount(transcript);

        yourVoice.text(transcript);
    }

    record.click(function (ev) {
        recognition.start();
    });
});