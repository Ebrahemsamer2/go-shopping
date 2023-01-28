class Ajax {
    static send = (url, formData, type, success) => {
        $.ajax({
            url: url,
            data: formData,
            type: type,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: success
        });
    }
}