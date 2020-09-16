import Chart from "chart.js"

window['Chart'] = Chart;

export default (ctx: HTMLCanvasElement|string, options?: Object) => {
    if (typeof ctx === 'string')
        ctx = <HTMLCanvasElement> document.getElementById(ctx)

    options = window['_'].merge({
        options: {
            maintainAspectRatio: false
        }
    }, options)

    return new Chart(ctx.getContext('2d'), options)
}
