$.fn.skillTip = function() {
	var tooltip = $("#d3up-tooltip"),
      container = $("<div class='d3-tooltip'/>"),
			header = $("<div class='top skill'/>"),
			content = $("<div class='item'/>"),
			footer = $("<div class='bottom'/>"),
			desc = $("<p class='skill-desc'>").append($(this).data("tooltip"));
	if($(this).data("type") == 'passive') {
		var icon = $("<span class='passive-icon'><img src='" + $(this).data("icon") + "'></span>");
	} else {
		var icon = $("<span class='d3-icon d3-icon-skill d3-icon-skill-42' style='background-image: url(" + $(this).data("icon") + ")'><span class='frame'></span>");
	}
	header.html($("<p>").append($(this).data("name")));
	content.append(icon, desc);
	container.append(header, content, footer);
	$(this).mouseover(function() {
		var $this = $(this);
		tooltip.css({
				position: 'absolute'
		});
		tooltip.empty().append(container);
		var position = {
			of: $this,
			at: "center bottom",
			my: "center top",
			offset: "0 10",
			collision: "flip"
		};
		tooltip.appendTo("body").position(position);
	}).mouseout(function() {
		tooltip.empty();
	});
}
function checkSkillTip() {
	$(this).skillTip();			
}
$(function() {
	$(".d3-icon-skill, .passive-icon").each(checkSkillTip);	
});

Handlebars.registerHelper('skillIcon', function(heroClass, name) {
	// Check to ensure we have the data from the gamedata.js
	if(!d3up.gameData) return false
	var container = $("<span class='d3-icon d3-icon-skill d3-icon-skill-42' data-type='skill'>"),
			frame = $("<span class='frame'>"),
			active = d3up.gameData.actives[heroClass][name];
	container.attr("data-tooltip", "<p>" + active.desc + "</p>");
	if(active.rune) {
		container.attr("data-tooltip", container.attr("data-tooltip") + "<p>" + active.rune + "</p>");
	}
	container.attr("data-name", active.name);
	// Fix up the Class and Skill Name for Blizzard's URLs
	heroClass = heroClass.replace(/-/g, "");
	name = name.replace(/-/g, "").split("~")[0];	
	var icon = "http://media.blizzard.com/d3/icons/skills/42/" + heroClass + "_" + name + ".png";
	container.css({backgroundImage: 'url("' + icon + '")'});
	container.attr("data-icon", icon);
	// Find the Passive in D3Up's game data
	return new Handlebars.SafeString($("<div>").append(container.append(frame)).html());
});

Handlebars.registerHelper('passiveIcon', function(heroClass, name) {
	// Check to ensure we have the data from the gamedata.js
	if(!d3up.gameData) return false
	var container = $("<span class='passive-icon' data-type='passive'>"),
			image = $("<img style='width:32px; height:32px'>"),
			passive = d3up.gameData.passives[heroClass][name];
	container.attr("data-tooltip", passive.desc);
	container.attr("data-name", name.replace(/-/g, " ").capitalize());
	// Fix up the Class and Skill Name for Blizzard's URLs
	heroClass = heroClass.replace(/-/g, "");
	name = name.replace(/-/g, "");	
	var icon = "http://media.blizzard.com/d3/icons/skills/42/" + heroClass + "_passive_" + name + ".png";
	image.attr("src", icon);
	container.attr("data-icon", icon);
	// Find the Passive in D3Up's game data
	return new Handlebars.SafeString($("<div>").append(container.append(image)).html());
});
