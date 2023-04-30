(function ($) {
    const bulk_selector_wrap = $("#bulk-action-selector-top").closest("div.tablenav");

    let template_options = "";
    ajax_obj.templates.forEach((templates) => {
        template_options += `<option value="${templates.name}">${templates.name}</option>`;
    });

    const input_template_subject = `<input id="template_subject" name="template_subject" placeholde="信件主旨" type="text" style="display:none;" />`;

    const choose_template_wrap = `
    <select name="template_applied" id="template_applied" style="display:none;">
    <option value="">請選擇要發送的 Email 範本</option>
        ${template_options}
    </select>
    ${input_template_subject}
    `;



    $("#bulk-action-selector-top").after(choose_template_wrap);
    $("#bulk-action-selector-top").closest("div.tablenav").after('<div id="save_status"></div>');


    // 選擇發送EMAIL時，跳出選單
    $("#bulk-action-selector-top").on("change", function (e) {
        if ($(this).val() == "send_email") {
            $("#template_applied, #template_subject").show();
            $("#doaction").on("click", function (e) {
                if ($("#template_applied").val() == "") {
                    e.preventDefault();
                    alert("請選擇要發送的 Email 範本");
                }
            });
        }else{
            $("#template_applied, #template_subject").hide();
        }
    });

    // 選擇EMAIL版型時，儲存到db
    $("#template_applied").on("change", function (e) {
        save_to_db();
    });
    $("#template_subject").on("keydown", function (e) {
        save_to_db();
    });

    function save_to_db(){
        $.ajax({
            type: "POST",
            url: ajax_obj.ajaxurl,
            //dataType: "json",
            data: {
                action: "save_template_to_db",
                nounce: ajax_obj.nounce,
                template: $("#template_applied").val(),
                subject: $('#template_subject').val(),
            },
            beforeSend: function () {
                $("#save_status").text("正在套用中...請稍等...");
            },
            success: function (data) {
                // Handle the complete event
                $("#save_status").text("✅ 成功套用 Email 範本");
                console.log("已存到DB");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#save_status").text("⚠️ 套用 Email 範本失敗，請聯絡系統管理員 ⚠️");
                console.log("套用", XMLHttpRequest, textStatus, errorThrown);
            },
        });
    }
})(jQuery);
