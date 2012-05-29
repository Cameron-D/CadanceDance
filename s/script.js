var ytplayer = null,
	interval = ((60 / bpm) / 10) * 2000,
	frame = 1,
	lights = false,
	create = true,
	party = false,

//give the images a moment to load before we start the animation
setTimeout('setInterval("update()",interval)', 1000); 

function update() {
	//Increment the current frame number
    frame++;
    if (frame > 10) { //10 is the total number of frames
        frame = 1;
    }
	
	//On the 5th frame (When the characters are on the ground)
	// we change the lights
    if (frame == 5) {
        effects(false);
    }
	
	//On the 10th frame (They are on the ground again)
	// change the lights and make the screen flash, if enabled
    if (frame == 10) {
        effects(true);
    }
    $("#animation img").hide();
    $("#frame" + frame).show();
}

//controls the flashing lights
function effects(alternate) {
	
	//Change the lights to a random colour
    if (lights) {
        $("#lights").css("background-color",
			"rgba(" + rnd() + "," + rnd() + "," + rnd() + ",0.2)");
    }
	
	//If PARTY HARD is enabled and this is the alternate beat
	// show the white div and make it fade out by the next beat
    if (party && alternate) {
        $("#party").show().fadeOut(interval * 5);
    }
}

//Generates the random value for the lights colour
function rnd() {
    return Math.floor(Math.random() * 255);
}

$(document).ready(function () {
	//Button for toggling the lights
    $("#lightson").click(function () {
        if (lights) {
            $("#lightson").text("Turn the lights on");
            $("#lights").hide();
        } else {
            $("#lightson").text("Turn the lights off");
            $("#lights").show();
        }
        lights = !lights;
        return false;
    });
	//Button for toggling the creation div
    $("#showcreate").click(function () {
        if (create) {
            $("#createcontent").hide();
            $("#showcreate").text("Create");
        } else {
            $("#createcontent").show();
            $("#showcreate").text("Hide");
        }
        create = !create;
        return false;
    });
	//Button for toggling PARTY HARD mode
    $("#partyhard").click(function () {
        if (party) {
            $("#partyhard").text("PARTY HARD!");
        } else {
            $("#partyhard").text("Partly Gently");
        }
        party = !party;
        return false
    });
	//Play/pause buttons
    $("#play").click(function () {
        if (ytplayer) {
            ytplayer.playVideo();
            return false;
        }
    });
    $("#stop").click(function () {
        if (ytplayer) {
            ytplayer.pauseVideo();
            return false;
        }
    });
});

//Initilise the YouTube player and JS API
swfobject.embedSWF("http://www.youtube.com/e/" + video +
		"?loop=1&enablejsapi=1&playerapiid=ytplayer",
		"ytapiplayer", "1", "1", "8", null, null,
		{ allowScriptAccess: "always" }, { id: "myytplayer" });

//This fiews when the YouTube player has loaded
function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById("myytplayer");
	
	//used to detect when the video has reached the end
    ytplayer.addEventListener("onStateChange", "stateChange");
	
	//Higher video quality = better sound quality.
	//This appears to be broken now :/
    ytplayer.setPlaybackQuality("large");
	
	//Jump to the specified start time and start playing
    ytplayer.seekTo(time, true);
    ytplayer.playVideo();
}
function stateChange(state) {
	//State 0 = end of video
    if (state == 0) {
		//So make it play over again!
        ytplayer.playVideo();
    }
}