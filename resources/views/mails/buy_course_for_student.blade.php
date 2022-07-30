<p>Kính gửi Quý học viên: <strong>{{ $student->getFullName() }}</strong>,</p>
<p>Lớp Vẽ Online xin trân trọng thông báo Quý học viên đã đăng ký khoá học vẽ online tại Lớp Vẽ Online với thông như sau:</p>
<p>Tên Học viên: {{ $student->getFullName() }}</p>
<p>Tên Học viên: {{ $student->phone_number }}</p>
<p>Email: {{ $student->email }}</p>
<p>Khoá học đăng ký: {{ $course->name }}</p>
<p>Tình trạng: Chờ phê duyệt </p>
<p>Để hỗ trợ Quý học viên trong việc truy cập vào bài học, Quý học viên vui lòng thực hiện thành công phương thức thanh toán như sau (bỏ qua thông báo này nếu đã thanh toán):
</p>
<p>Chủ tài khoản: Nguyễn Tâm
</p>
<p>Số tài khoản: 000 000 0000 000
</p>
<p>Ngân hàng: Vietcombank chi nhánh Hai Bà Trưng, Hà Nội
</p>
<p>Số tiền: {{ number_format($course->getCurrentPrice(), 0, ',', '.') }} VND</p>
<p>Nội dung chuyển khoản: DANG KY KHOA HOC {{ $course->name }} SDT {{ $student->phone_number }}</p>
<p>Sau khi chuyển khoản thành công, Quý học viên vui lòng đợi thông báo tiếp theo phê duyệt khoá học. Nếu cần biết thêm thông tin chi tiết, vui lòng gọi điện đến số Hotline: 0987654321 hoặc gửi email về địa chỉ: info.lopveonline@gmail.com để được hỗ trợ.</p>
<p>Lớp Vẽ Online xin cảm ơn Quý học viên đã tin tưởng và lựa chọn khoá học của chúng tôi.
</p>
<p>Kính chúc Quý học viên sức khoẻ, và đạt được hiệu quả cao sau khi kết thúc Khoá học.
</p>
<p>Trân trọng,
</p>
