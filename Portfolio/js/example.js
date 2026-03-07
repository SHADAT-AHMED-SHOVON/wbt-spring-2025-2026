// ============================================================
// 1) OUTPUT (Printing)
// ============================================================
console.log("Hello, JavaScript!");
console.warn("This is a warning.");
console.error("This is an error message.");

// ============================================================
// 2) VARIABLES: var, let, const
// ============================================================
// var: old style (function-scoped) — avoid for new code when possible
var oldSchool = "I am var";

// let: modern (block-scoped) — use when value will change
let age = 18;
age = 19;

// const: modern (block-scoped) — use when you won't reassign the variable
const country = "Bangladesh";

// IMPORTANT: const does NOT mean “immutable” for objects/arrays; it means “not reassignable”.
const numbers = [1, 2, 3];
numbers.push(4); // allowed (array contents change)
console.log("numbers:", numbers);

// ============================================================
// 3) DATA TYPES (Primitive + Reference)
// ============================================================
// Primitives: string, number, boolean, null, undefined, symbol, bigint
const name = "Riyad";          // string
const score = 99.5;            // number
const isActive = true;         // boolean
const emptyValue = null;       // null (intentional empty)
let notSet;                    // undefined (not assigned yet)
const bigNumber = 9007199254740993n; // bigint (note the 'n')

// Reference types: object, array, function
const person = { firstName: "Wahidul", lastName: "Alam" }; // object
const fruits = ["mango", "banana"];                        // array
function greet() { return "Hi!"; }                         // function

console.log(typeof name, typeof score, typeof isActive);
console.log("typeof null is:", typeof null); // historical JS bug: "object"

// ============================================================
// 4) TYPE CONVERSION (Casting)
// ============================================================
const strNum = "42";
console.log(Number(strNum));      // 42
console.log(String(123));         // "123"
console.log(Boolean(""));         // false
console.log(Boolean("hello"));    // true

// parseInt / parseFloat for strings with extra characters
console.log(parseInt("50px", 10)); // 50
console.log(parseFloat("3.14cm")); // 3.14

// ============================================================
// 5) OPERATORS (Common ones)
// ============================================================
const a = 10;
const b = 3;

console.log("a + b =", a + b);
console.log("a - b =", a - b);
console.log("a * b =", a * b);
console.log("a / b =", a / b);
console.log("a % b =", a % b); // remainder

// Comparison
console.log(5 == "5");   // true  (loose equality: tries to convert types)
console.log(5 === "5");  // false (strict equality: no type conversion) preferred
console.log(5 !== "5");  // true

// Logical
console.log(true && false); // AND
console.log(true || false); // OR
console.log(!true);         // NOT

// Nullish coalescing (useful for defaults)
const maybeValue = null;
console.log(maybeValue ?? "default"); // "default" (only null/undefined triggers default)

// Optional chaining (avoid crashes when property may not exist)
const user = { profile: { email: "a@b.com" } };
console.log(user.profile?.email);      // "a@b.com"
console.log(user.settings?.theme);     // undefined (no crash)

// ============================================================
// 6) STRINGS (Common patterns)
// ============================================================
const first = "Wahidul";
const last = "Riyad";

// Template literals (recommended)
console.log(`Full name: ${first} ${last}`);

// Common string methods
const text = " JavaScript is fun! ";
console.log(text.trim());            // remove whitespace ends
console.log(text.toUpperCase());
console.log(text.includes("fun"));   // true
console.log(text.replace("fun", "powerful"));

// ============================================================
// 7) CONDITIONALS (if/else, switch, ternary)
// ============================================================
const temp = 30;

if (temp > 35) {
    console.log("Too hot!");
} else if (temp >= 25) {
    console.log("Warm.");
} else {
    console.log("Cool.");
}

// Ternary operator: quick conditional expression
const message = temp >= 25 ? "T-shirt weather" : "Bring a jacket";
console.log(message);

// switch: good for many exact matches
const day = "Friday";
switch (day) {
    case "Friday":
        console.log("Weekend soon!");
        break;
    case "Saturday":
    case "Sunday":
        console.log("Weekend!");
        break;
    default:
        console.log("Weekday.");
}

// ============================================================
// 8) LOOPS (for, while, for...of, for...in)
// ============================================================
// for
for (let i = 0; i < 3; i++) {
    console.log("for i =", i);
}

// while
let count = 0;
while (count < 2) {
    console.log("while count =", count);
    count++;
}

// for...of (iterates values) best for arrays
for (const fruit of fruits) {
    console.log("fruit:", fruit);
}

// for...in (iterates keys) best for objects
for (const key in person) {
    console.log("person key:", key, "value:", person[key]);
}

// ============================================================
// 9) FUNCTIONS (declaration, expression, arrow)
// ============================================================
// Function declaration (hoisted)
function add(x, y) {
    return x + y;
}
console.log("add:", add(2, 3));