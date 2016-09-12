function setActiveTab(currentTab) {
    if (currentTab) {
        $('#forRent').attr("class", "tab-pane fade active in");
        $('.forRent-nav').attr("class", "forRent-nav active");
    } else {
        $('#needRent').attr("class", "tab-pane fade active in");
        $('.needRent-nav').attr("class", "needRent-nav active");
    }
};
