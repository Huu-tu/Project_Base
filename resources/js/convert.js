export function convertDate(inputDate) {
    let date = new Date(inputDate);
    // Chuyển đổi sang định dạng AM/PM
    let hours = date.getHours() % 12 || 12;
    let minutes = date.getMinutes();
    // let period = date.getHours() >= 12 ? " PM" : " AM";
    // Chuyển đổi sang định dạng ngày/tháng/năm
    let day = date.getDate();
    let month = date.getMonth() + 1; // Tháng trong JavaScript đếm từ 0, nên cần +1
    let year = date.getFullYear();
    // Xuất giờ cuối cùng
    let outputDate = `${hours}:${minutes
        .toString()
        .padStart(2, "0")} ${day.toString().padStart(2, "0")} th ${month.toString().padStart(2, "0")}, ${year}`;
    return outputDate;
}
