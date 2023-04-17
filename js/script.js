var str = "07:00:00";
arr = str.split(":");
var time = Number(arr[0])*3600+Number(arr[1])*60+Number(arr[2]);
while (true) {
    time -= 1;
    arr[0] = parseInt(time/3600);
    arr[1] = parseInt(time / 3600) % 60;
    arr[2] =parseInt(time % 60);
    str = arr.join(":");
    $.sleep(1000);
    console.log(str);
}
