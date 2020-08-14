import {DotsExercise} from "./Exercise/DotsExercise";

interface Dot {
    x: number;
    y: number;
}

function distance(dot: Dot): number
{
    return Math.sqrt(dot.x * dot.x + dot.y * dot.y);
}

const exercise = new DotsExercise(1000, document.querySelector('canvas'));

let inside = 0;
let outside = 0;

for (const dot of exercise.dots) {
    distance(dot) <= 100
        ? inside++
        : outside++
    ;
}

console.info({
    inside,
    outside,
    ratio: inside / exercise.totalDots,
    fourRatio: 4 * (inside / exercise.totalDots),
    pi: Math.PI
});

console.info('done');
