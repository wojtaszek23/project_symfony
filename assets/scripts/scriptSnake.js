var canvas;
var context;
var time;

var body_x = new Array();
var body_y = new Array();
var body_direction = new Array();

var board_x = new Array();
var board_y = new Array();
var board_is_free = new Array();

var apple_x;
var apple_y;
var apple_img;
var apple_is_placed;

var snake_speed;
var snake_head_down_img;
var snake_head_right_img;
var snake_head_up_img;
var snake_head_left_img;
var snake_segment_down_img;
var snake_segment_right_img;
var snake_segment_up_img;
var snake_segment_left_img;
var snake_direction;

var cell_width=50;
var cell_height=50;

var score = 0;
var game_difficulty = 0;

var started;

function bodyBuild(x,y,direction){
    body_x.unshift(x);
    body_y.unshift(y);
    body_direction.unshift(direction);
}

function boardInit(){
    for(var i = 0 ; i < 200 ; i++)
    {
        board_x.push((i%20)*50);
	board_y.push((Math.floor(i/20))*50);
	board_is_free.push(true);
    }
}

function appleInit(x,y,img_name){
    apple_x = x;
    apple_y = y;
    apple_img = null;
    apple_img = new Image()
    apple_img.src = img_name;
}

function appleReplace(){
    if ( body_x.length == 200 ){
        score = score + game_difficulty;
        document.getElementById('scores').innerHTML = "Score: " + score;
        return;
    }
    context.clearRect(apple_x,apple_y,cell_width,cell_height);
    var rand_id = Math.floor(Math.random() * (board_x.length-body_x.length));
    var calc_rand_id=0;
    var i = 0;
    for ( ; i<=rand_id ; i++ )
    {
	if (board_is_free[i] == false)
	{
	    calc_rand_id++;
	}
    }
	
    if(rand_id!=i){
	rand_id = calcApplePlace(rand_id,calc_rand_id);}
	
    while(board_is_free[rand_id%200]==false)
    {
	rand_id++;
    }
    rand_id=rand_id%200;
    apple_x = board_x[rand_id];
    apple_y = board_y[rand_id];
    context.drawImage(apple_img,apple_x,apple_y);
    apple_is_placed = true;
    score = score + game_difficulty;
    document.getElementById('scores').innerHTML = "Score: " + score;
}

function calcApplePlace(rand_id,calc_rand_id){
    var i = rand_id 
    for( ; i < rand_id + calc_rand_id ; i++)
    {
	if ( board_is_free[i] == true )
	{
	    calc_rand_id--;
	}
    }
    rand_id = i;
    if(calc_rand_id == 0)
    {
	return rand_id;
    }
    else
    {
	return calcApplePlace(rand_id,calc_rand_id);
    }
}

function gameInit(){
    boardInit();
    started = false;
    drawStartText();
    document.onkeydown = checkKeyStart;
}

function gameStart(){
    document.onkeydown = null;
    appleInit(8*cell_width,4*cell_height,"/images/snake/apple.png");
    snakeInit(); 
    score = 0;
    setTimeout(initialDrawing,250);
}

function initialDrawing(){
    context.clearRect(0, 0, canvas.width, canvas.height);
    context.drawImage(apple_img,apple_x,apple_y);
    context.drawImage(snake_head_right_img,body_x[0],body_y[0]);
    context.drawImage(snake_segment_right_img,body_x[1],body_y[1]);
    context.drawImage(snake_segment_right_img,body_x[2],body_y[2]);
    context.drawImage(snake_segment_right_img,body_x[3],body_y[3]);
    document.onkeydown = checkKey;
}

checkKeyStart = function(e){
    switch (e.keyCode){
        case 86: // 'v'
            game_difficulty = 1;
            break;
        case 69: // 'e'
            game_difficulty = 2;
            break;
        case 77: // 'm'
            game_difficulty = 3;
            break;
        case 72: // 'h'
            game_difficulty = 4;
            break;
        case 85: // 'u'
            game_difficulty = 5;
            break;
        case 82: // 'r'
            window.location.href = '/';
            break;
    }

    if (game_difficulty > 0)
    {
        gameStart();
    }
}
	
checkKey = function(e){
    var willMove = true;
    if(e.keyCode == 37 && body_direction[0] != "left" && body_direction[0] != "right")
    {
        snake_direction = "left";
    }
    else if(e.keyCode == 38 && body_direction[0] != "up" && body_direction[0] != "down")
    {
        snake_direction = "up";
    }
    else if(e.keyCode == 39 && body_direction[0] != "right" && body_direction[0] != "left")
    {
        snake_direction = "right";       
    }
    else if(e.keyCode == 40 && body_direction[0] != "down" && body_direction[0] != "up")
    {
        snake_direction = "down";
    }
    else
    {
	if ( started == false && e.keyCode == 39 )
	{
	    started = true;
	    snake_direction = "right";
	}
	else
	{
            willMove = false;
	}
    }

    if (willMove == true)
    {
        snakeMove();
    }
}

function stopGame(){
    clearTimeout(time);
    document.onkeydown = null;
}

function end(){
    redrawSnake();
    drawEndText();
    drawStartText();

    body_x = null;
    body_y = null;
    body_direction = null;
    board_x = null;
    board_y = null;
    board_is_free = null;

    body_x = new Array();
    body_y = new Array();
    body_direction = new Array();
    board_x = new Array();
    board_y = new Array();
    board_is_free = new Array();

    game_difficulty = 0;

    gameInit();
}

function snakeInit(){
    snake_speed=50;
    snake_head_down_img = null;
    snake_head_down_img = new Image();
    snake_head_down_img.src = '/images/snake/head_1.png';
    snake_head_right_img = null;
    snake_head_right_img = new Image();
    snake_head_right_img.src = '/images/snake/head_2.png';
    snake_head_up_img = null;
    snake_head_up_img = new Image();
    snake_head_up_img.src = '/images/snake/head_3.png';
    snake_head_left_img = null;
    snake_head_left_img = new Image();
    snake_head_left_img.src = '/images/snake/head_4.png';
    snake_segment_down_img = null;
    snake_segment_down_img = new Image();
    snake_segment_down_img.src = '/images/snake/segment_1.png';
    snake_segment_right_img = null;
    snake_segment_right_img = new Image();
    snake_segment_right_img.src = '/images/snake/segment_2.png';
    snake_segment_up_img = null;
    snake_segment_up_img = new Image();
    snake_segment_up_img.src = '/images/snake/segment_3.png';
    snake_segment_left_img = null;
    snake_segment_left_img = new Image();
    snake_segment_left_img.src = '/images/snake/segment_4.png';
    bodyBuild(1*cell_width,4*cell_height,"right");
    bodyBuild(2*cell_width,4*cell_height,"right");
    bodyBuild(3*cell_width,4*cell_height,"right");
    bodyBuild(4*cell_width,4*cell_height,"right");
    var id = body_x[0] / 50 + body_y[0] / 2.5;
    board_is_free[id] =  false;
    id = body_x[1] / 50 + body_y[1] / 2.5;
    board_is_free[id] =  false;
    id = body_x[2] / 50 + body_y[2] / 2.5;
    board_is_free[id] =  false;
    id = body_x[3] / 50 + body_y[3] / 2.5;
    board_is_free[id] =  false;
}

function snakeMove(){
    if( time != null )
    {
        clearTimeout(time);
    }
    snakeCalcBody();
    var last_segment_x = null;
    var last_segment_y = null;
    var apple_eaten = true;
    if (checkEat() == false)
    {
        apple_eaten = false;
        lastSegment_x = body_x.pop();
	lastSegment_y = body_y.pop();
    }    
    if (checkCrashBorder() == true || checkCrashBody() == true)
    {
        stopGame();
        context.clearRect(body_x[1],body_y[1],cell_width,cell_height);
	body_direction[1] = body_direction[0];
	body_x.shift();
	body_y.shift();
	body_direction.shift();
        end();
        return;
    }
    if ( lastSegment_x != null )
    {
        context.clearRect(lastSegment_x,lastSegment_y,50,50);
	var id = lastSegment_x/50 + lastSegment_y/2.5;
	board_is_free[id] =  true;
    }
    if ( apple_eaten == true || apple_is_placed == false )
    {
        appleReplace();
    }
    redrawSnake();
    
    var tmp_v_time;
    
    if ( game_difficulty == 1 )
    {
        tmp_v_time = 1000;
    }
    else if ( game_difficulty == 2 )
    {
        tmp_v_time = 500;
    }
    else if ( game_difficulty == 3 )
    {
        tmp_v_time = 250;
    }
    else if ( game_difficulty == 4 )
    {
        tmp_v_time = 150;
    }
    else if ( game_difficulty == 5 )
    {
        tmp_v_time = 100;
    }

    time = setTimeout(snakeMove,tmp_v_time);
}

function drawStartText(){
context.font = "italic bold 40px Arial";
context.textAlign = "center";
context.textBaseline = "middle";
context.fillStyle = "#FFFFFF";
context.fillText('If you want to play game, push key choosing level: ', 500, 250);

context.font = "italic bold 40px Arial";
context.textAlign = "center";
context.textBaseline = "middle";
context.fillStyle = "#FFFFFF";
context.fillText("v-ery easy | e-asy | m-edium | h-ard | u-ltimate", 500, 375);

context.font = "italic bold 40px Arial";
context.textAlign = "center";
context.textBaseline = "middle";
context.fillStyle = "#FFFFFF";
context.fillText("r - to return to the homepage", 500, 450);
}

function drawEndText(){
context.font = "italic bold 40px Arial";
context.textAlign = "center";
context.textBaseline = "middle";
context.fillStyle = "#FFFFFF";
context.fillText("Game ended with " + score + " points", 500, 100);
}

function redrawSnake(){
    context.clearRect(body_x[1],body_y[1],cell_width,cell_height);
    switch(body_direction[0])
    {
	case "right":
            context.drawImage(snake_head_right_img,body_x[0],body_y[0]);
	    break;
	case "up":
	    context.drawImage(snake_head_up_img,body_x[0],body_y[0]);
	    break;
	case "left":
	    context.drawImage(snake_head_left_img,body_x[0],body_y[0]);
	    break;
	case "down":
	    context.drawImage(snake_head_down_img,body_x[0],body_y[0]);
	    break;
    }
    switch(body_direction[1])
    {
	case "right":
	    context.drawImage(snake_segment_right_img,body_x[1],body_y[1]);
	    break;
	case "up":
	    context.drawImage(snake_segment_up_img,body_x[1],body_y[1]);
	    break;
        case "left":
	    context.drawImage(snake_segment_left_img,body_x[1],body_y[1]);
	    break;
	case "down":
	    context.drawImage(snake_segment_down_img,body_x[1],body_y[1]);
	    break;
	}
}

function snakeCalcBody(){
    bodyBuild(body_x[0],body_y[0],snake_direction);
    switch (snake_direction)
    {
        case "up":
            body_y[0]=body_y[1]-snake_speed;
        break;
        case "down":
            body_y[0]=body_y[1]+snake_speed;
        break;
        case "right":
		    body_x[0]=body_x[1]+snake_speed;
        break;
        case "left":
            body_x[0]=body_x[1]-snake_speed;
        break;
        default:
        break;
    }
    board_is_free[(body_x[0]/50)+(body_y[0]/2.5)] = false;
    return;
}

function checkEat(){
    if ( checkCollision ( body_x[0], body_y[0], cell_width, cell_height,
apple_x, apple_y, cell_width, cell_height ) == true )
    {
        return true;
    }
    return false;
}

function checkCrashBorder(){
    var x1 = body_x[0];
    var y1 = body_y[0];
    var w1 = cell_width;
    var h1 = cell_height;
    if ( x1 < 0 || y1 < 0 || x1 + w1 > canvas.width || y1 + h1 > canvas.height )
    {
        return true;
    }
    else
    {
        return false;
    }
}

function checkCrashBody(){
    var x1 = body_x[0];
    var y1 = body_y[0];
    var w1 = cell_width;
    var h1 = cell_height;
    for ( var i = 4; i < body_x.length ; i++ )
    {
        var x2 = body_x[i];
        var y2 = body_y[i];
        var w2 = cell_width;
        var h2 = cell_height;
        if ( checkCollision(x1,y1,w1,h1,x2,y2,w2,h2) == true )
        {
            return true;
        }
    }
    return false;
}

function checkCollision(x1,y1,w1,h1,x2,y2,w2,h2){
    if ((y1+h1<=y2)||(y1>=y2+h2)||(x1+w1<=x2)||(x1>=x2+w2))
    {
        return false;
    }
    else
    {
	return true;
    }
}

document.addEventListener("DOMContentLoaded",function(event){
    canvas = document.getElementById('canvas');
    context = canvas.getContext('2d');
    gameInit();
    });
