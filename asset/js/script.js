


function coba(){
    let v = document.querySelector(".container");
    v.setAttribute("style", "display:none;")

    let gra = document.querySelector('.pie');
    gra.removeAttribute("style");


    startGame();
}

var myGamePiece;
var myObstacles = [];
var myScore;

function startGame() {
    var amimir = document.querySelector('.color').value;
    myGamePiece = new component(30, 30, amimir, 10, 120);
    myScore = new component("19px", "Consolas", amimir, 650, 20, "text");
    myObstacles = [];
    myGameArea.start();

    

    var pie = document.querySelector('.pie');
    pie.style.color = amimir;
}




var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = 800;
        this.canvas.height = 200;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
        this.interval = setInterval(updateGameArea, 20);
        window.addEventListener('keydown', function (e) {
            myGameArea.keys = (myGameArea.keys || []);
            myGameArea.keys[e.keyCode] = (e.type == "keydown");
        })
        window.addEventListener('keyup', function (e) {
            myGameArea.keys[e.keyCode] = (e.type == "keydown");            
        })
        },
        
        clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    stop : function() {
        clearInterval(this.interval);
    }
}

function component(width, height, color, x, y, type) {
    this.type = type;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;    
    this.update = function() {
        ctx = myGameArea.context;
        if (this.type == "text") {
            ctx.font = this.width + " " + this.height;
            ctx.fillStyle = color;
            ctx.fillText(this.text, this.x, this.y);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
    this.newPos = function() {
        this.x += this.speedX;
        this.y += this.speedY;        
    }
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y;
        var mybottom = this.y + (this.height);
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;
        }
        return crash;
    }
}

function updateGameArea() {
    var x, height, gap, minHeight, maxHeight, minGap, maxGap;
    for (i = 0; i < myObstacles.length; i += 1) {    
        if (myGamePiece.crashWith(myObstacles[i])) {
            
            var yuka = document.createElement("button");
            yuka.setAttribute("id", "btns");
            yuka.setAttribute("onclick", "restart()");
            yuka.textContent = "Try Again"
            
            var exit = document.createElement("button");
            exit.setAttribute("id", "btns2");
            exit.setAttribute("onclick", "window.location.reload()");
            exit.textContent = "Exit"
            
            document.body.append(yuka)
            document.body.append(exit)
            myGameArea.stop();
            return;
        }}

        
        myGameArea.clear();
        myGameArea.frameNo += 1;
        if (myGameArea.frameNo == 1 || everyinterval(150)) {
            x = myGameArea.canvas.width;
            minHeight = 20;
            maxHeight = 200;
            height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
            minGap = 50;
            maxGap = 200;
            gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
            myObstacles.push(new component(10, height, "green", x, 0));
            myObstacles.push(new component(10, x - height - gap, "green", x, height + gap));
        }
        for (i = 0; i < myObstacles.length; i += 1) {
            myObstacles[i].speedX = -1;
        myObstacles[i].newPos();
        myObstacles[i].update();
    }
    myScore.text="Score: " + myGameArea.frameNo;
    myScore.update();
    if (myGameArea.keys && myGameArea.keys [37]) {myGamePiece.speedX = -1; }
    if (myGameArea.keys && myGameArea.keys [39]) {myGamePiece.speedX = 1; }
    if (myGameArea.keys && myGameArea.keys [38]) {myGamePiece.speedY = -1; }
    if (myGameArea.keys && myGameArea.keys [40]) {myGamePiece.speedY = 1; }
    myGamePiece.newPos();    
    myGamePiece.update();
}



function everyinterval(n) {
    if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
    return false;
}

function accelerate(n) {
    myGamePiece.gravity = n;
}


    
    function restart() {
        myGameArea.stop();
        myGameArea.clear();
        startGame();

        let w = document.querySelector('#btns');
        w.remove();

        let y = document.querySelector('#btns2');
        y.remove()
    }

    // myScore.text="SCORE: " + myGameArea.frameNo;
    // myScore.update();
    // myGamePiece.newPos();    
    // myGamePiece.update();
    
    