<p>Kính gửi Quý học viên: <strong>{{ $student->getFullName() }}</strong>,</p>
<p>Vườn nghệ thuật Dâu Tây (SAG) xin trân trọng thông báo Quý học viên đã đăng ký khoá học vẽ online tại SAG với thông như sau:</p>
<p>Tên Học viên: {{ $student->getFullName() }}</p>
<p>Tên Học viên: {{ $student->phone_number }}</p>
<p>Email: {{ $student->email }}</p>
<p>Khoá học đăng ký: {{ $course->name }}</p>
<p>Tình trạng: Chờ phê duyệt </p>
<p>Để hỗ trợ Quý học viên trong việc truy cập vào bài học, Quý học viên vui lòng thực hiện thành công phương thức thanh toán như sau (bỏ qua thông báo này nếu đã thanh toán):
</p>
<p>Chủ tài khoản: Phạm Quỳnh Anh
</p>
<p>Số tài khoản: 030 1000 337 097
</p>
<p>Ngân hàng: Vietcombank chi nhánh Hoàn Kiếm, Hà Nội
</p>
<p>Số tiền: {{ number_format($course->getCurrentPrice(), 0, ',', '.') }} VND</p>
<p>Nội dung chuyển khoản: DANG KY KHOA HOC {{ $course->name }} SDT {{ $student->phone_number }}</p>
<p>Sau khi chuyển khoản thành công, Quý học viên vui lòng đợi thông báo tiếp theo phê duyệt khoá học. Nếu cần biết thêm thông tin chi tiết, vui lòng gọi điện đến số Hotline 1: 0969 872 072 (Ms Linh)/ Hotline 2: 0975 307 160 (Ms Quỳnh Anh) hoặc gửi email về địa chỉ: info.strawberryartgarden@gmail.com để được hỗ trợ.</p>
<p>SAG xin cảm ơn Quý học viên đã tin tưởng và lựa chọn khoá học của chúng tôi.
</p>
<p>Kính chúc Quý học viên sức khoẻ, và đạt được hiệu quả cao sau khi kết thúc Khoá học.
</p>
<p>Trân trọng,
</p>
<br>
<p style="color: #d01d23"><strong>VƯỜN NGHỆ THUẬT DÂU TÂY – VẼ NÊN THẾ GIỚI RIÊNG BẠN</strong></p>
<p style="color: #80ab3f">Đào tạo các khoá học mỹ thuật từ cơ bản tới nâng cao <br>
    Gieo Hạt - Trồng Cây - Căn bản chì - Căn bản màu - Phong cảnh - Màu nước <br>
    Hình hoạ chì - Sơn dầu - Ký hoạ - Chân dung - Tranh lụa - Sơn mài
</p>
<p style="color: #d01d23"><strong>Khai giảng liên tục các khoá mỹ thuật cho mọi lứa tuổi</strong></p>
<p style="color: #80ab3f">Địa chỉ: P12A16 - Toà N03B - New Horizon City - 87 Lĩnh Nam, HM, HN <br>
    Hotline: 096 987 2072 <br>
    Email: info.strawberryartgarden@gmail.com <br>
    Website: vuonnghethuatdautay.vn <br>
    FB: https://www.facebook.com/Vuon.nghe.thuat.Dau.tay/
</p>
