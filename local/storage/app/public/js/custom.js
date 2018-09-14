$("#form-account").validate({
    ignore: [],
    rules: {
        'name': {
            required: true,
        },
        'phone': {
            required: true,
            phone: true
        },
        'sex': {
            required: true
        },
    },
    messages: {
        'name': {
            required: 'Vui lòng nhập tên của bạn',
        },
        'phone': {
            required: 'Vui lòng nhập số điện thoại',
            phone: 'Số điện thoại không hợp lệ'
        },
        'sex': {
            required: 'Giới tính không hợp lệ'
        },
    }
});