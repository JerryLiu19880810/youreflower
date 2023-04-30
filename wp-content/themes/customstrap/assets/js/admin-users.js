(function () {
    //隱藏
    const handle_advance_setting = (show = false) => {
        const selector = [".wrap > ul.subsubsub", ".tablenav > div.actions:nth-child(2)", "#role", ".column-role"];
        if (show) {
            selector.forEach((item) => {
                document.querySelectorAll(item).forEach((node) => {
                    node.classList.remove("d-none");
                });
            });
        } else {
            selector.forEach((item) => {
                document.querySelectorAll(item).forEach((node) => {
                    node.classList.add("d-none");
                });
            });
        }
    };

    //創建空容器
    const elem = document.createElement("div");
    elem.setAttribute("id", "advanced-setting");
    document.querySelector(".wrap > .wp-header-end").after(elem);

    const html = `
    <input type="checkbox" name="advance_setting_checkbox" id="advance_setting_checkbox" />
    <label htmlFor="advance_setting_checkbox">啟用進階選項</label>
`;

    //get php_user_data from php

    //render
    const advanced_setting = document.querySelector("#advanced-setting");
    advanced_setting.innerHTML = html;
    document.querySelectorAll('tr[id^="user-"]').forEach((item) => {
        //console.log(php_user_data[item.id])
        item.querySelector('img.avatar').src = php_user_data[item.id];
    })

    //事件
    const advance_setting_checkbox = document.querySelector("#advance_setting_checkbox");
    handle_advance_setting(advance_setting_checkbox.checked);
    advance_setting_checkbox.addEventListener("click", () => {
        handle_advance_setting(advance_setting_checkbox.checked);
    });
})();
