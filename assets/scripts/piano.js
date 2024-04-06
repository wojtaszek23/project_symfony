var last_key = -1;
  var pc_key = [];
  const piano = [];
  var piano_delay = [];
  var mouse_pressed = false;
  
  for(let i=0; i<61; i++)
  {
    let index = i+1;
    piano[i] = new Audio("/sounds/piano/f"+index+".mp3");
    piano[i].load();
    piano[i].currentTime = 0.25;
    piano_delay[i] = null;
  }
  
  var piano_free = [];
  for(let i=0; i<61; i++)
  {
    piano_free[i] = true;
  }
  
  const piano_div = document.getElementById("keyboard");
  const piano_key_white = document.querySelectorAll(".key_white");
  const piano_key_black = document.querySelectorAll(".key_black");
  const piano_key = document.querySelectorAll(".key_white, .key_black");
  
  function current_play_edit_state()
  {
    var play_state = document.getElementById("play_state").checked;
    var edit_state = document.getElementById("edit_state").checked;
    if(play_state == true && edit_state == false)
    {
      return "play";
    }
    else if(play_state == false && edit_state == true)
    {
      return "edit";
    }
    else
    {
      console.log("ERROR: play edit state checking error.");
      return "ERROR";
    }
  }
 
  function unpressed(nr)
  {
    var state = current_play_edit_state();
    if(state == "play")
    {
      piano_free[nr] = true;
      if(piano_key[nr].classList.contains("key_white_playing"))
      {
        piano_key[nr].classList.remove("key_white_playing");
      }
      else
      {
        piano_key[nr].classList.remove("key_black_playing");
      }
    }
  }
  
  document.body.onmousedown = function() {
    mouse_pressed = true;
  }
  document.body.onmouseup = function() {
    mouse_pressed = false;
  }
  
  function play(nr)
  {
    if(piano_free[nr] == true)
    {
      if(piano_key[nr].classList.contains("key_white"))
      {
	piano_key[nr].classList.add("key_white_playing");
      }
      else
      {
	piano_key[nr].classList.add("key_black_playing");
      }
      clearTimeout(piano_delay[nr]);
      piano[nr].pause();
      piano[nr].currentTime = 0.25;
      piano[nr].play();
      piano_free[nr] = false;
    };
  }
  
  function pause(nr)
  {
    if(piano_key[nr].classList.contains("key_white_playing"))
      {
	piano_key[nr].classList.remove("key_white_playing");
      }
      else
      {
	piano_key[nr].classList.remove("key_black_playing");
      }
    piano[nr].pause();
    piano[nr].currentTime = 0.25;
  }

  function pressed(nr){
    if(mouse_pressed == false)
    {
      return;
    }
    else
    {
      var state = current_play_edit_state();
    if(state == "edit")
    {
      if(last_key > -1)
      {
	piano_key[last_key].classList.remove("key_editing");
      }
      last_key = nr;
      piano_key[nr].classList.add("key_editing");
    }
    else if(state == "play")
    {
      piano_free[nr] = true;
      play(nr);
    }
  }
  }
 
  function set_key(char_key, nr)
  {
    piano_key[nr].innerHTML = char_key;
    pc_key[char_key.charCodeAt(0)] = nr;
  }
 
  $(document).ready(function(){
    for (let i = 0; i < piano_key.length; i++) {
      piano_key[i].addEventListener("mousedown", function(){mouse_pressed = true;pressed(i)});
      piano_key[i].addEventListener("mouseover", function(){pressed(i)});
      piano_key[i].addEventListener("mouseout", function(){unpressed(i)});
      piano_key[i].addEventListener("mouseup", function(){unpressed(i)});
    }
    
    $(document).keydown(function( event ){
      var key_nr = event.which;
      var sound_nr = pc_key[key_nr];
      var state = current_play_edit_state();
      if(state == "play" && piano_free[sound_nr] == true && pc_key[key_nr] != undefined)
      {
        play(sound_nr);
      }
      else if(state == "edit" && last_key > -1 && last_key < 61)
      {
        var char_key = String.fromCharCode(key_nr);
        for(let i = 0; i < 61; i++)
        {
          if(piano_key[i].innerHTML == char_key)
          {
            piano_key[i].innerHTML = "";
          }
        }
        pc_key[key_nr] = last_key;
        piano_key[last_key].innerHTML = String.fromCharCode(key_nr);
        piano_key[last_key].classList.remove("key_editing");
        last_key = -1;
      }
    });
    
    $(document).keyup(function( event ){
      var state = current_play_edit_state();
      var key_nr = event.which;
      if(state == "play" && pc_key[key_nr] != undefined)
      {
        var sound_nr = pc_key[key_nr];
        piano_free[sound_nr] = true;
        piano_delay[sound_nr] = setTimeout(pause,100,sound_nr);
      }
    });
    
    var play_edit_state = document.getElementById("play_state");
    play_edit_state.checked = true;
    
    set_key('Q',12);
    set_key('2',13);
    set_key('W',14);
    set_key('3',15);
    set_key('E',16);
    set_key('R',17);
    set_key('5',18);
    set_key('T',19);
    set_key('6',20);
    set_key('Y',21);
    set_key('7',22);
    set_key('U',23);
    set_key('I',24);
    set_key('9',25);
    set_key('O',26);
    set_key('0',27);
    set_key('P',28);
    
    set_key('Z',29);
    set_key('S',30);
    set_key('X',31);
    set_key('D',32);
    set_key('C',33);
    set_key('F',34);
    set_key('V',35);
    set_key('B',36);
    set_key('H',37);
    set_key('N',38);
    set_key('J',39);
    set_key('M',40);
    
    $("input[name='play_edit_state'][value='play']").on("change",function(){
      if(last_key == -1)
      {
        return;
      }
      else if(piano_key[last_key].classList.contains("key_editing"))
      {
        piano_key[last_key].classList.remove("key_editing");
      }
      last_key = -1;
    });
    
    $("input[name='play_edit_state'][value='edit']").on("change",function(){
      last_key = -1;
    });
  });
