//01
let a = 10;
let b = 20;

[a, b] = [b, a];

console.log(a);
console.log(b);

//02
function square(n) {
    return n * n;
}

for (let i = 1; i <= 10; i++) {
    console.log(square(i))
}

//03
const number = [1, 2, 3, 4, 5];
let x = 0;

for (let i = 0; i <= 4; i++) {
    if (x < number[i]) {
        x = number[i];
    }
}

console.log(x);