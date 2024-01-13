//Pin class.
class Pin {
    x;
    y;
    strokeStyle = "white";
    fillStyle = "#9013FE";
    lineWidth =6;
    radius = 8;
    
    constructor(x, y) {
        this.x = x;
        this.y = y;
    };
    
    draw(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0 , 2*Math.PI);
        ctx.strokeStyle=this.strokeStyle;
        ctx.fillStyle = this.fillStyle;
        ctx.lineWidth = this.lineWidth;
        ctx.stroke();
        ctx.fill();
    }
};

export default Pin;