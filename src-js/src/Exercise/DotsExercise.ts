export interface Dot {
    x: number;
    y: number;
}

function distance(dot: Dot): number
{
    return Math.sqrt(dot.x * dot.x + dot.y * dot.y);
}

export class DotsExercise {

    public readonly totalDots: number;
    public readonly canvas: HTMLCanvasElement;
    public readonly dots: Dot[];

    constructor(totalDots: number, canvas: HTMLCanvasElement) {
        this.totalDots = totalDots;
        this.canvas = canvas;
        this.dots = [];

        for (let i = 0; i < this.totalDots; i++) {
            this.dots.push({
                x: (Math.random() * 200 | 0) - 100,
                y: (Math.random() * 200 | 0) - 100
            });
        }

        this.setupCanvas();

        this.draw();
    }

    private draw(): void
    {
        const context = this.canvas.getContext('2d');
        context.beginPath();
        context.moveTo(10, 110);
        context.lineTo(210, 110);
        context.moveTo(110, 10);
        context.lineTo(110, 210);
        context.stroke();

        context.beginPath();
        context.moveTo(210, 110);
        context.arc(110, 110, 100, 0, 2 * Math.PI);
        context.stroke();

        context.beginPath();
        context.rect(10, 10, 200, 200);
        context.stroke();

        for (const dot of this.dots) {
            context.beginPath();
            if (distance(dot) > 100) {
                context.strokeStyle = 'rgba(194, 24, 7, 0.25)'
                context.fillStyle = 'rgba(194, 24, 7, 0.25)'
            } else {
                context.strokeStyle = 'rgba(12, 56, 166, 0.25)'
                context.fillStyle = 'rgba(12, 56, 166, 0.25)'
            }

            context.arc(dot.x + 110, dot.y + 110, 1, 0, 2 * Math.PI);
            context.stroke();
            context.fill();
        }
    }

    private setupCanvas(): void {
        const dpr = window.devicePixelRatio;
        const rect = this.canvas.getBoundingClientRect();
        this.canvas.width = rect.width * dpr;
        this.canvas.height = rect.height * dpr;
        const ctx = this.canvas.getContext('2d');
        ctx.scale(dpr, dpr);
    }
}
