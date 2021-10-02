const arr = [];
const interval = 30;
const period = 2 * 24;
const currentDate = new Date();

for (let index = period; index >= 0; index--) {
    const futureDate = new Date(currentDate.getTime() - ((interval * 60000) * index))
    if (
        (futureDate.getHours() === 2 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 4 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 6 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 8 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 10 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 12 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 14 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 16 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 18 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 20 && futureDate.getMinutes() <= 30) ||
        (futureDate.getHours() === 22 && futureDate.getMinutes() <= 30)
    ) {
        // arr.push(`${futureDate.getFullYear()}-${((futureDate.getMonth() < 10) ? `0${futureDate.getMonth()}` : futureDate.getMonth())}-${((futureDate.getDate() < 10) ? `0${futureDate.getDate()}` : futureDate.getDate())} ${((futureDate.getHours() < 10) ? `0${futureDate.getHours()}` : futureDate.getHours())}:${((futureDate.getMinutes() < 10) ? `0${futureDate.getMinutes()}` : futureDate.getMinutes())}`)
        arr.push(`${((futureDate.getHours() < 10) ? `0${futureDate.getHours()}` : futureDate.getHours())}:${((futureDate.getMinutes() < 10) ? `0${futureDate.getMinutes()}` : futureDate.getMinutes())}`)
    } else if (futureDate.getHours() === 0 && futureDate.getMinutes() <= 30) {
        arr.push(`${((futureDate.getDate() < 10) ? `0${futureDate.getDate()}` : futureDate.getDate())}-${((futureDate.getMonth() < 10) ? `0${futureDate.getMonth()}` : futureDate.getMonth())}`)
    } else {
        arr.push('')
    }
}



console.log(arr);
