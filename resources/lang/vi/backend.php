<?php

return [
    'common'            => [
        'logo'              => 'ThueNhanh.net',
        'mini_logo'         => 'TN',
        'toggle_nav'        => 'Điều hướng',
        'logout'            => 'Thoát',
        'management'        => 'Quản Lý',
        'posts'             => 'Bài Đăng',
        'posts_activated'   => 'Đang Hoạt Động',
        'posts_waitting'    => 'Đang Chờ Duyệt',
        'posts_closed'      => 'Đã Đóng',
        'posts_deleted'     => 'Đã xoá',
        'reports'           => 'Báo cáo',
        'reports_waitting'  => 'Chờ Xử Lý',
        'reports_processed' => 'Đã Xử Lý',
        'accounts'          => 'Tài Khoản',
        'acc_admins'        => 'Ban Quản Trị',
        'acc_mems'          => 'Thành Viên',
        'acc_deactivated'   => 'Chưa Kích Hoạt',
        'acc_banned'        => 'Đã Bị Khoá',
        'categories'        => 'Chuyên Mục',
        'repo'              => 'GitHub Repo',
        'copyright'         => 'Copyright &copy; 2016',
        'rights'            => 'All rights reserved.',
        'author'            => 'at-sontd',
        'insufficient_role' => 'Tài khoản không có quyền truy cập.',
    ],
    'errors'            => [
        '401'               => 'Truy Cập Bị Từ Chối',
        'unauthorized'      => 'Unauthorized',
        'access_denied'     => 'Truy cập bị từ chối!',
        '401_message'       => 'Bạn chưa đăng nhập hoặc không có quyền truy cập vào địa chỉ này!',
    ],
    'posts'             => [
        'waitcensor'        => [
            'title'             => 'Danh Sách Chờ Duyệt',
            'field_title'       => 'Tiêu Đề',
            'field_category'    => 'Chuyên Mục',
            'field_city'        => 'Tỉnh/Thành Phố',
            'field_user'        => 'Người Đăng',
            'field_time'        => 'Thời Gian',
            'field_options'     => 'Lựa Chọn',
            'del_confirm'       => 'Xác Nhận',
            'del_msg'           => 'Xác nhận xoá bài viết này?',
            'btn_cancel'        => 'Huỷ',
            'btn_yes'           => 'Xoá',
            'del_success'       => 'Đã xoá!',
            'del_fails'         => 'Lỗi! Không thể xoá.',
        ],
    ],
    'users'             => [
        'members'           => [
            'title'             => 'Thành Viên',
            'id'                => 'ID',
            'name'              => 'Tên',
            'email'             => 'Email',
            'city'              => 'Tỉnh/TP',
            'date'              => 'Ngày Tham Gia',
            'options'           => 'Lựa Chọn',
            'ban_confirmation'  => 'Khoá Tài Khoản',
            'ban_confirm_msg'   => 'Xác nhận cấm truy cập tài khoản này?',
            'btn_ban'           => 'Khoá',
            'btn_close'         => 'Huỷ',
            'btn_set'           => 'Lưu',
            'config_title'      => 'Cài Đặt Quyền',
            'mod'               => 'Mod',
            'admin'             => 'Admin',
            'd_mod_l1'          => 'Kiểm duyệt bài.',
            'd_mod_l2'          => 'Xoá bài.',
            'd_mod_l3'          => 'Xoá bình luận.',
            'd_admin_l1'        => 'Xử lý báo cáo.',
            'd_admin_l2'        => 'Khoá/Mở tài khoản.',
            'd_admin_l3'        => 'Cấp/Huỷ quyền Mod cho thành viên.',
            'cog_success'       => 'Đã cập nhật quyền cho tài khoản :user',
            'cog_fails'         => 'Lỗi, không thể cập nhật quyền lúc này!',
            'ban_success'       => 'Tài khoản :user đã bị khoá!',
            'ban_fails'         => 'Lỗi, không thể khoá tài khoản lúc này!',
        ]
    ]
];
