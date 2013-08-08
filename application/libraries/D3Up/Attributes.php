<?php
/**
 * Diablo Attributes found on Items
 *
 * @package default
 * @author Aaron Cox
 **/
class D3Up_Attributes 
{
	public static $quality = array(
		0 => 'Junk',
		1 => 'Junk',
		2 => 'Common',
		3 => 'Uncommon',
		4 => 'Magic',
		5 => 'Rare',
		6 => 'Legendary',
		7 => 'Set',
	);
	
	public static $itemTypes = array(
		"2h-axe" => "Two-Handed Axe",
		"2h-mace" => "Two-Handed Mace",
		"2h-mighty" => "Two-Handed Mighty Weapon",
		"2h-sword" => "Two-Handed Sword",
		"amulet" => "Amulet",
		"axe" => "Axe",
		"belt" => "Belt",
		"boots" => "Boots",
		"bow" => "Bow",
		"bracers" => "Bracers",
		"ceremonial-knife" => "Ceremonial Knife",
		"chest" => "Chest Armor",
		"cloak" => "Cloak",
		"crossbow" => "Crossbow",
		"dagger" => "Dagger",
		"daibo" => "Daibo",
		"fist-weapon" => "Fist Weapon",
		"gloves" => "Gloves",
		"hand-crossbow" => "Hand Crossbow",
		"helm" => "Helm",
		"mace" => "Mace",
		"mighty-belt" => "Mighty Belt",
		"mighty-weapon" => "Mighty Weapon",
		"mojo" => "Mojo",
		"pants" => "Pants",
		"polearm" => "Polearm",
		"quiver" => "Quiver",
		"ring" => "Ring",
		"shield" => "Shield",
		"shoulders" => "Shoulders",
		"source" => "Source",
		"spear" => "Spear",
		"spirit-stone" => "Spirit Stone",
		"staff" => "Staff",
		"sword" => "Sword",
		"voodoo-mask" => "Voodoo Mask",
		"wand" => "Wand",
		"wizard-hat" => "Wizard Hat"
	);
	
	public static $attributes = array(
		'en' => array(
			'empty-socket' => 'Empty Socket',
			// Damages
			'min-damage' => '+[v] Minimum Damage',
			'max-damage' => '+[v] Maximum Damage',
			'minmax-damage' => '+[v]-[v] Damage',
			// % Elemental Damage
			'plus-arcane-damage' => '+[v]% to Arcane Damage',
			'plus-cold-damage' => '+[v]% to Cold Damage',
			'plus-fire-damage' => '+[v]% to Fire Damage',
			'plus-holy-damage' => '+[v]% to Holy Damage',
			'plus-lightning-damage' => '+[v]% to Lightning Damage',
			'plus-poison-damage' => '+[v]% to Poison Damage',
			'plus-arcane-damage~2' => 'Adds [v]% to Arcane Damage',
			'plus-cold-damage~2' => 'Adds [v]% to Cold Damage',
			'plus-fire-damage~2' => 'Adds [v]% to Fire Damage',
			'plus-holy-damage~2' => 'Adds [v]% to Holy Damage',
			'plus-lightning-damage~2' => 'Adds [v]% to Lightning Damage',
			'plus-poison-damage~2' => 'Adds [v]% to Poison Damage',
			// Elemental Damage
			'arcane-damage' => '+[v]-[v] Arcane Damage',
			'cold-damage' => '+[v]-[v] Cold Damage',
			'fire-damage' => '+[v]-[v] Fire Damage',
			'holy-damage' => '+[v]-[v] Holy Damage',
			'lightning-damage' => '+[v]-[v] Lightning Damage',
			'poison-damage' => '+[v]-[v] Poison Damage',
			// Elemental Damage Skills
			'plus-arcane-damage-skills' => 'Arcane skills deal [v]% more damage',
			'plus-cold-damage-skills' => 'Cold skills deal [v]% more damage',
			'plus-fire-damage-skills' => 'Fire skills deal [v]% more damage',
			'plus-holy-damage-skills' => 'Holy skills deal [v]% more damage',
			'plus-lightning-damage-skills' => 'Lightning skills deal [v]% more damage',
			'plus-poison-damage-skills' => 'Poison skills deal [v]% more damage',
			// Percent Damage
			'plus-damage' => '+[v]% Damage',
			// Strength
			'strength' => '+[v] Strength',
			// Dexterity
			'dexterity' => '+[v] Dexterity',
			// Intelligence
			'intelligence' => '+[v] Intelligence',
			// Vitality
			'vitality' => '+[v] Vitality',
			// Attack Speed
			'plus-aps' => '+[v] Attacks per Second',
			'attack-speed' => 'Attack speed increased by [v]%',
			// Resistances
			'arcane-resist' => '+[v] Arcane Resistance',
			'cold-resist' => '+[v] Cold Resistance',
			'fire-resist' => '+[v] Fire Resistance',
			'lightning-resist' => '+[v] Lightning Resistance',
			'physical-resist' => '+[v] Physical Resistance',
			'poison-resist' => '+[v] Poison Resistance',
			'resist-all' => '+[v] Resistance to All Elements',
			// stun Chance
			// Life On Hit
			'life-hit' => 'Each hit adds +[v] Life',
			// Life on Kill
			'life-kill' => '+[v] Life after each Kill',
			// Damage vs. Monster Types
			'demon-damage' => '+[v]% Damage to Demons',
			// % Life
			'plus-life' => '+[v]% Life',
			// Armor
			'armor' => '+[v] Armor',
			// Crit Damage
			'critical-hit-damage' => 'Critical Hit Damage increased by [v]%',
			// Misc
			'indestructible' => 'Ignores durability loss',
			'plus-gold-find' => '+[v]% Extra Gold from Monsters',
			// Life Max
			'life-regen' => 'Regenerates [v] Life per Second',
			'plus-magic-find' => '[v]% Better Chance of finding Magic Items',
			// Class Resource Affixes
			'fury-max' => '+[v] Maximum Fury',
			'hatred-regen' => 'Increases Hatred Regeneration by [v] per Second',
			'max-discipline' => '+[v] Maximum Discipline',
			'spirit-regen' => 'Increases Spirit Regeneration by [v] per Second',
			'mana-regen' => 'Increases Mana Regeneration by [v] per Second',
			'mana-max' => '+[v] Maximum Mana',
			'ap-max' => '+[v] Maximum Arcane Power',
			'ap-regen' => 'Increases Arcane Power regeneration by [v] per second.',
			// Movement_Speed
			'plus-movement' => '+[v]% Movement Speed',
			// Life Steal
			'life-steal' => '[v]% of Damage Dealt is Converted to Life',
			// Thorns
			'thorns' => 'Melee attackers take [v] damage per hit',
			// Block Chance
			'plus-block' => '+[v]% Chance to Block',
			// Crit %
			'critical-hit' => 'Critical Hit Chance increased by [v]%',
			// Spending Resource Heals
			'spirit-spent-life' => 'Gain [v] Life per Spirit Spent',
			// Critical hits grant resource
			'ap-on-crit' => 'Critical Hits grant [v] Arcane Power',
			// XP Bonus
			'plus-experience' => 'Monster kills grant +[v] experience',
			'plus-experience-percent' => 'Increased Experience Rewarded per Kill by [v]%',
			'plus-experience-bonus' => 'Increases Bonus Experience by [v]%',
			// Health Globe Bonus
			'health-globes' => 'Health Globes and Potions Grant +[v] Life',
			// Gold_PickUp_Radius
			'plus-pickup-radius' => 'Increases Gold and Health pickup by [v] yards',
			// CrowdControl_Reduction
			'cc-reduce' => 'Reduces the duration of control impairing effects by [v]%',
			// On Hit procs like fear, stun, blind, chill
			'chance-bleed' => '[v]% chance to inflict Bleed for [v] damage over 5 seconds',
			'chance-blind' => '[v]% chance to Blind on Hit',
			'chance-chill' => '[v]% chance to Chill on Hit',
			'chance-fear' => '[v]% chance to Fear on Hit',
			'chance-freeze' => '[v]% chance to Freeze on Hit',
			'chance-immobilize' => '[v]% chance to Immobilize on Hit',
			'chance-knockback' => '[v]% chance to Knockback on Hit',
			'chance-slow' => '[v]% chance to Slow on Hit',
			'chance-stun' => '[v]% chance to Stun on Hit',
			'chance-whirlwind' => 'Chance to occasionally Whirlwind furioulsy.',
			'chance-ball-energy' => 'Chance to hurt a ball of pure energy when attacking.',
			'chance-skeleton' => 'Summons a skeleton when attacked.',
			'chance-reflect-projectiles' => 'Chance to reflect projectiles when hit.',
			'effect-poison-cloud' => 'You are sourrounded by a deadly Posion Cloud.',
			// Reduced damage from ranged/melee/elites
			'elite-reduce' => 'Reduces damage from elites by [v]%',
			'melee-reduce' => 'Reduces damage from melee attacks by [v]%',
			'range-reduce' => 'Reduces damage from ranged attacks by [v]%',
			'cold-reduce' => 'Reduces damage from Cold attacks by [v]%.',
			// Damage to Elites
			'elite-damage' => 'Increases Damage against Elites by [v]%',
			// Reduced damage/increased damage from elemental types
			'bb-bash' => 'Increases bash damage by [v]%',
			'bb-cleave' => 'Increases cleave damage by [v]%',
			'bb-frenzy' => 'Increases frenzy damage by [v]%',
			'bb-rend' => 'Reduces resource cost of Rend by [v] Fury',
			'bb-revenge' => 'Increases Critical Hit Chance of Revenge by [v]%',
			'bb-weapon-throw' => 'Reduces resource cost of Weapon Throw by [v] Fury',
			'bb-hammer-of-the-ancients' => 'Reduces resource cost of Hammer of the Ancients by [v] Fury',
			'bb-whirlwind' => 'Increases Critical Hit Chance of Whirlwind by [v]%',
			'bb-overpower' => 'Increases Critical Hit Chance of Overpower by [v]%',
			'bb-seismic-slam' => 'Increases Critical Hit Chance of Seismic Slam by [v]%',
			'bb-weapon-throw-dmg' => 'Increases Weapon Throw damage by [v]%',
			'bb-ancient-spear-dmg' => 'Increases Ancient Spear damage by [v]%',
			// Demon Hunter
			'dh-chakram' => 'Reduces resource cost of Chakram by [v] Hatred',
			'dh-evasive-fire' => 'Increases Evasive Fire damage by [v]%',
			'dh-grenades' => 'Increases Grenades Damage by [v]%',
			'dh-impale' => 'Reduces resource cost of Impale by [v] Hatred',
			'dh-spike-trap' => 'Increases Spike Trap damage by [v]%',
			'dh-bola-shot' => 'Increases Bola Shot damage by [v]%',
			'dh-elemental-arrow' => 'Increases Elemental Arrow damage by [v]%',
			'dh-entangling-shot' => 'Increases Entangling Shot damage by [v]%',
			'dh-hungering-arrow' => 'Increases Hungering Arrow damage by [v]%',
			'dh-multishot' => 'Increases Critical Hit Chance of Multishot by [v]%',
			'dh-rapid-fire' => 'Increases Critical Hit Chance of Rapid Fire by [v]%',
			'dh-cluster-arrow' => 'Reduces resource cost of Cluster Arrow by [v] Hatred',
			'dh-strafe' => 'Increases Critical Hit Chance of Strafe by [v]%',
			// Monk
			'mk-crippling-wave' => 'Increases Crippling Wave damage by [v]%',
			'mk-cyclone-strike' => 'Reduces resource cost of Cyclone Strike by [v] Spirit',
			'mk-deadly-reach' => 'Increases Deadly Reach damage by [v]%',
			'mk-exploding-palm' => 'Increases Exploding Palm damage by [v]%',
			'mk-fists-of-thunder' => 'Increases Fist of Thunder damage by [v]%',
			'mk-sweeping-wind' => 'Increases Sweeping Wind damage by [v]%',
			'mk-sweeping-wind-cost' => 'Reduces resource cost of Sweeping Wind by [v] Spirit.',
			'mk-way-of-the-hundred-fists' => 'Increases Way of the Hundred Fists damage by [v]%',
			'mk-lashing-tail-kick' => 'Reduces resource cost of Lashing Tail Kick by [v] Spirit',
			'mk-tempest-rush' => 'Increases Critical Hit Chance of Tempest Rush by [v]%',
			'mk-wave-of-light' => 'Increases Critical Hit Chance of Wave of Light by [v]%',
			// Witch Doctor
			'wd-firebomb' => 'Reduces resource cost of Firebomb by [v] Mana',
			'wd-haunt' => 'Increases Haunt Damage by [v]%',
			'wd-acid-cloud' => 'Increases Critical Hit Chance of Acid Clouds by [v]%',
			'wd-firebats' => 'Reduces resource cost of Firebats by [v] Mana',
			'wd-zombie-dogs' => 'Reduces cooldown of Summon Zombie Dogs by [v] Seconds',
			'wd-plague-of-toads' => 'Increases Plague of Toads damage by [v]%',
			'wd-poison-darts' => 'Increaeses Poison Darts damage by [v]%',
			'wd-spirit-barrage' => 'Increases Spirit Barrage damage by [v]%',
			'wd-wall-of-zombies' => 'Reduces cooldown of Wall of Zombies by [v] Seconds',
			'wd-zombie-charger' => 'Reduces resource cost of Zombie Charger by [v] Mana',
			'wd-gargantuan' => 'Reduces cooldown of Gargantuan by [v] seconds',
			// Wizard
			'wz-arcane-torrent' => 'Reduces resource cost of Arcane Torrent by [v] Arcane Power',
			'wz-disintegrate' => 'Reduces resource cost of Disintegrate by [v] Arcane Power',
			'wz-electrocute' => 'Increases Electrocute damage by [v]%',
			'wz-explosive-blast' => 'Increases Critical Hit Chance of Explosive Blast by [v]%',
			'wz-hydra' => 'Reduces resource cost of Hydra by [v] Arcane Power',
			'wz-ray-of-frost' => 'Increases Critical Hit Chance of Ray of Frost by [v]%',
			'wz-energy-twister' => 'Increases Critical Hit Chance of Energy Twister by [v]%',
			'wz-magic-missle' => 'Increases Magic Missle damage by [v]%',
			'wz-arcane-orb' => 'Increases Critical Hit Chance of Arcane Orb by [v]%',
			'wz-blizzard' => 'Increases duration of Blizzard by [v] Seconds',
			'wz-meteor' => 'Reduces resource cost of Meteor by [v] Arcane Power',
			'wz-shock-pulse' => 'Increases Shock Pulse damage by [v]%',
			'wz-spectral-blade' => 'Increases Spectral Blade damage by [v]%',
			// Legendaries
			'pig-sticker' => 'Squeal!',
			'leg-blood-magic-blade' => 'Blood oozes from you.',
			'leg-wizardspike' => '[v]% chance to hurl a frozen orb when attacking.',
			'leg-the-gidbinn' => 'Chance to summon a Fetish when attacking.',
			'leg-last-breath' => 'Slain enemies rest in pieces.',
			'leg-skycutter' => 'Chance to summon angelic assistance when attacking.',
			'leg-sever' => 'Slain enemies rest in pieces.',
			'leg-azurewrath' => 'This weapon will forcefully repel undead enemies.',
			'leg-scourge' => '20% chance to explode with demonic fury when attacking.',
			'leg-maximus' => 'Chance to summon a Demonic Slave when attacking.',
			'leg-genzaniku' => 'Chance to summon a ghostly Fallen Champion when attacking.',
			'leg-the-butchers-sickle' => '20% chance to drag enemies to you when attacking.',
			'leg-the-burning-axe-of-sankis' => 'Chance to fight through the pain when enemies hit you.',
			'leg-sky-splitter' => '10% chance to Smite enemies when you hit them.',
			'leg-butchers-carver' => 'The Butcher still inhabits his carver.',
			'leg-fire-brand' => '25% chance to cast a fireball when attacking.',
			'leg-odyn-son' => '20% chance to Chain Lightning enemies when you hit them.',
			'leg-earthshatter' => '20% chance to cause the ground to shudder when attacking.',
			'leg-boneshatter' => 'Slain enemies rest in pieces.',
			'leg-cataclysm' => '25% chance to sunder the ground your enemies walk on when you attack.',
			'leg-schaeferss-hammer' => '25% chance to be protected by Lightning when you are hit.',
			'leg-vigilance' => 'Chance to cast Inner Sanctuary when you are hit.',
			'leg-the-ravens-wing' => 'Ravens flock to your side.',
			'leg-cluckeye' => '25% chance to cluck when attacking.',
			'leg-demon-machine' => '35% chance to shoot explosive bolts when attacking.',
			'leg-buriza-do-kyanon' => '40% chance for ranged projectiles to pierce enemies.',
			'leg-pus-spitter' => '25% chance to lob an acid blob when attacking.',
			'leg-hellrack' => 'Chance to root enemies to the ground when you hit them.',
			'leg-calamity' => '20% chance to target enemies with Marked for Death when you hit them.',
			'leg-fjord-cutter' => '20% chance to be surrounded by a Chilling Aura when attacking.',
			'leg-the-paddle' => 'Slap!',
			'leg-flying-dragon' => 'Chance to double your attack speed when attacking.',
			'leg-maloths-focus' => 'Enemies occasionally flee at the sight of this staff.',
			'leg-the-tormentor' => 'Chance to charm enemies when you hit them.',
			'leg-sloraks-madness' => 'This wand finds your death humorous.',
			'leg-wall-of-bone' => '20% chance to be protected by a shield of bones when you are hit.',
			'leg-lidless-wall' => 'You have a chance to be shielded when hit by enemies.',
			'leg-andariels-visage' => '20% chance to cast a Poison Nova when you are hit.',
			'leg-fire-walkers' => 'Burn the ground you walk on.',
			'leg-goldskin' => 'Chance for enemies to drop gold when you hit them.',
			'leg-pox-faulds' => 'These pants occasionally make you stink.',
			'leg-death-watch-mantle' => '15% chance to explode with knives when hit by enemies.',
			'leg-the-grin-reaper' => 'Chance to summon horrific Mimics when attacking.',
			'leg-storm-crow' => '20% chance to cast a fiery ball when attacking.',
			'leg-thunder-gods-vigor' => '25% chance to cause Shock Pulse to erupt from your enemies when you hit them.',
			'leg-moonlight-ward' => '25% chance to be surrounded by balls of Arcane Power when attacking.',
			'leg-puzzle-ring' => 'This ring sometimes calls forth a Treasure Goblin when you are hit.',
			'leg-bul-kathoss-wedding-band' => 'You drain life from enemies around you.',
			'leg-band-of-hollow-whispers' => 'This ring occasionally haunts nearby enemies.',
			'leg-bul-kathoss-warrior-blood' => 'You occasionally Whirlwind furiously.',
			'leg-shenlongs-relentless-assault' => 'Chance to hurl a ball of pure energy when attacking.',
			'leg-manajumas-gory-fetch' => 'You are surrounded by a deadly Poison Cloud.',
			'leg-litany-of-the-undaunted' => 'This ring sometimes summons a Skeleton when you attack.',
			'leg-demons-flight' => 'Chance to reflect projectiles when you are hit by enemies.',
			'leg-the-murlocket' => 'Call forth a creature from the depths.',
			// Reduced level requirement
			'level-reduce' => 'Level Requirement reduced by [v]',
			// D3Up Specific
			'ruby-damage' => '+[v] Minimum and +[v] Maximum Damage',
		),
		// More languages!
		'es' => array(),
		'de' => array(),
	);
	
	public static $_statMap = array(
		// Stats
		'dexterity' => 0,
		'intelligence' => 1,
		'strength' => 2,
		'vitality' => 3,
		// Life
		'life-regen' => 4,
		'life-kill' => 5,
		'life-hit' => 6,
		'spirit-spent-life' => 7,
		'life-steal' => 8,
		// Misc
		'plus-magic-find' => 9, 
		'plus-gold-find' => 10,
		'plus-experience' => 11,
		'plus-movement' => 12,
		'plus-pickup-radius' => 13,
		'level-reduce' => 14,
		// Damage Abilities
		'plus-damage' => 15, 
		'critical-hit' => 16, 
		'critical-hit-damage' => 17,
		'attack-speed' => 18,
		'min-damage' => 19,
		'max-damage' => 20,
		// Defensive
		'armor' => 21, 
		'plus-block' => 22,
		'melee-reduce' => 23,
		'range-reduce' => 24, 
		'elite-reduce' => 25,
		'thorns' => 26, 
		'cc-reduce' => 27,
		// Resists
		'resist-all' => 28,
		'physical-resist' => 29,
		'cold-resist' => 30,
		'fire-resist' => 31, 
		'lightning-resist' => 32,
		'poison-resist' => 33,
		'arcane-resist' => 34,
		'plus-life' => 35,
		'sockets' => 36,
		// Elemental Damage Bonuses on Weapons
		'cold-damage' => 37,
		'poison-damage' => 38,
		'holy-damage' => 39,
		'arcane-damage' => 40,
		'lightning-damage' => 41,
		'fire-damage' => 42,
	);
	
	protected static $_limits = array(
		array(
			'types' => 'axe|ceremonial-knife|hand-crossbow|dagger|fist-weapon|mace|mighty-weapon|spear|sword|wand',
			'values' => array(
				350,		// dexterity
				350,    // intelligence
				350,    // strength
				350,    // vitality
				0,      // life-regen
				2878,   // life-kill
				959,    // life-hit
				64,     // spirit-spent-life
				3,      // life-steal
				0,      // plus-magic-find
				0,      // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				18,     // level-reduce
				50,     // plus-damage
				0,      // critical-hit
				100,    // critical-hit-damage
				11,     // attack-speed
				352,    // min-damage
				447,    // max-damage
				0,      // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				0,      // thorns
				0,      // cc-reduce
				0,      // resist-all
				0,      // physical-resist
				0,      // cold-resist
				0,      // fire-resist
				0,      // lightning-resist
				0,      // poison-resist
				0,      // arcane-resist
				0,      // plus-life
				1       // sockets
			),
		),
		array(
		  'types' => '2h-mace|2h-axe|bow|daibo|crossbow|2h-mighty|polearm|staff|2h-sword',
		  'values' => array(
				595,		// dexterity
				595,    // intelligence
				595,    // strength
				595,    // vitality
				0,      // life-regen
				5756,   // life-kill
				1918,   // life-hit
				0,      // spirit-spent-life
				6,      // life-steal
				0,      // plus-magic-find
				0,      // plus-gold-find
				0,      // plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				18,     // level-reduce
				50,     // plus-damage
				0,      // critical-hit
				200,    // critical-hit-damage
				11,     // attack-speed
				478,    // min-damage
				611,    // max-damage
				0,      // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				0,      // thorns
				0,      // cc-reduce
				0,      // resist-all
				0,      // physical-resist
				0,      // cold-resist
				0,      // fire-resist
				0,      // lightning-resist
				0,      // poison-resist
				0,      // arcane-resist
				0,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'mojo|source|quiver',
			'values' => array(
				301,		// dexterity
				301,    // intelligence
				301,    // strength
				301,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				0,      // level-reduce
				0,      // plus-damage
				10,    // critical-hit
				0,      // critical-hit-damage
				15,     // attack-speed
				0,      // min-damage
				0,      // max-damage
				0,      // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				979,    // thorns
				0,      // cc-reduce
				0,      // resist-all
				0,      // physical-resist
				0,      // cold-resist
				0,      // fire-resist
				0,      // lightning-resist
				0,      // poison-resist
				0,      // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'shield',
			'values' => array(
				350,		// dexterity
				350,		// intelligence
				350,    // strength
				350,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				0,      // level-reduce
				0,      // plus-damage
				10,     // critical-hit
				0,      // critical-hit-damage
				15,     // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				9,      // plus-block
				6,      // melee-reduce
				6,      // range-reduce
				7,      // elite-reduce
				2544,   // thorns
				14,     // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				16,			// plus-life
				1       // sockets
			),        
		),          
		array(
			'types' => 'spirit-stone',
			'values' => array(
				300,		// dexterity
				200,    // intelligence
				200,    // strength
				200,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				30,     // spirit-spent-life
				0,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				16,     // level-reduce
				0,      // plus-damage
				6,    // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				14,     // cc-reduce
				70,     // resist-all
				50,     // physical-resist
				50,     // cold-resist
				50,     // fire-resist
				50,     // lightning-resist
				50,     // poison-resist
				50,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'voodoo-mask',
			'values' => array(
				200,		// dexterity
				300,		// intelligence
				200,    // strength
				200,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				16,     // level-reduce
				0,      // plus-damage
				6,    // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				14,     // cc-reduce
				70,     // resist-all
				50,     // physical-resist
				50,     // cold-resist
				50,     // fire-resist
				50,     // lightning-resist
				50,     // poison-resist
				50,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),          
		array(
			'types' => 'wizard-hat',
			'values' => array(
				200,		// dexterity
				300,    // intelligence
				200,    // strength
				200,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				16,     // level-reduce
				0,      // plus-damage
				6,    // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				14,     // cc-reduce
				70,     // resist-all
				50,     // physical-resist
				50,     // cold-resist
				50,     // fire-resist
				50,     // lightning-resist
				50,     // poison-resist
				50,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'cloak',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				200,    // strength
				300,    // vitality
				410,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				16,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				6,      // range-reduce
				0,      // elite-reduce
				2544,   // thorns
				0,      // cc-reduce
				70,     // resist-all
				50,     // physical-resist
				50,     // cold-resist
				50,     // fire-resist
				50,     // lightning-resist
				50,     // poison-resist
				50,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'mighty-belt',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				300,    // strength
				200,    // vitality
				234,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				3,      // life-steal
				18,     // plus-magic-find
				20,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				16,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				2544,   // thorns
				0,      // cc-reduce
				70,     // resist-all
				50,     // physical-resist
				50,     // cold-resist
				50,     // fire-resist
				50,     // lightning-resist
				50,     // poison-resist
				50,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'helm',
			'values' => array(
				200,		// dexterity
				300,    // intelligence
				200,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				6,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				14,     // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				12,     // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'belt',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				300,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				2544,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				12,     // plus-life
				0,			// sockets
			),        
		),
		array(
			'types' => 'amulet',
			'values' => array(
				350,		// dexterity
				350,    // intelligence
				350,    // strength
				350,    // vitality
				499,    // life-regen
				2878,   // life-kill
				959,    // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				45,     // plus-magic-find
				50,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				0,      // level-reduce
				0,      // plus-damage
				10,     // critical-hit
				100,    // critical-hit-damage
				9,      // attack-speed
				27,     // min-damage
				27,     // max-damage
				397,    // armor
				0,      // plus-block
				6,      // melee-reduce
				6,      // range-reduce
				0,      // elite-reduce
				1712,   // thorns
				14,     // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				16,     // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'boots',
			'values' => array(
				300,		// dexterity
				200,    // intelligence
				200,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				12,     // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				0,      // plus-life
				0,			// sockets
			),        
		),
		array(
			'types' => 'bracers',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				200,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				6,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				6,      // melee-reduce
				6,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				0,      // plus-life
				0,			// sockets
			),        
		),
		array(
			'types' => 'chest',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				200,    // strength
				300,    // vitality
				599,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				6,      // melee-reduce
				6,      // range-reduce
				7,      // elite-reduce
				2544,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				12,     // plus-life
				3,			// sockets
			),        
		),
		array(
			'types' => 'gloves',
			'values' => array(
				300,		// dexterity
				300,    // intelligence
				200,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				10,     // critical-hit
				50,     // critical-hit-damage
				9,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				0,      // plus-life
				0,			// sockets
			),        
		),
		array(
			'types' => 'pants',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				200,    // strength
				300,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				397,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				1454,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				0,      // plus-life
				2,			// sockets
			),        
		),
		array(
			'types' => 'ring',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				200,    // strength
				200,    // vitality
				342,    // life-regen
				1439,    // life-kill
				479,    // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				22,    	// plus-experience
				0,      // plus-movement
				0,      // plus-pickup-radius
				0,      // level-reduce
				0,      // plus-damage
				6,    	// critical-hit
				50,     // critical-hit-damage
				9,      // attack-speed
				36,     // min-damage
				86,     // max-damage
				240,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				979,    // thorns
				14,     // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				12,      // plus-life
				1,			// sockets
			),        
		),
		array(
			'types' => 'shoulders',
			'values' => array(
				200,		// dexterity
				200,    // intelligence
				300,    // strength
				200,    // vitality
				342,    // life-regen
				0,      // life-kill
				0,      // life-hit
				0,      // spirit-spent-life
				0,      // life-steal
				20,     // plus-magic-find
				25,     // plus-gold-find
				24,     // plus-experience
				0,      // plus-movement
				7,      // plus-pickup-radius
				18,     // level-reduce
				0,      // plus-damage
				0,      // critical-hit
				0,      // critical-hit-damage
				0,      // attack-speed
				0,      // min-damage
				0,      // max-damage
				265,    // armor
				0,      // plus-block
				0,      // melee-reduce
				0,      // range-reduce
				0,      // elite-reduce
				2544,   // thorns
				0,      // cc-reduce
				80,     // resist-all
				60,     // physical-resist
				60,     // cold-resist
				60,     // fire-resist
				60,     // lightning-resist
				60,     // poison-resist
				60,     // arcane-resist
				12,     // plus-life
				0,			// sockets
			),        
		)
	);
	
	static protected $_order = array(
		
	);
	
	static protected $_typeMap = array();
	
	static protected $_instance = NULL;

	static public function getInstance()
	{
	 if (static::$_instance === NULL) {
			foreach(static::$_limits as $idx => $dataSet) {
				foreach(explode("|", $dataSet['types']) as $t) {
					static::$_typeMap[$t] = $idx;
				}
			}
	   static::$_instance = new static();
	 }
	 return static::$_instance;
	}
	
	static public function getArray() {
	  $return = array();
	  foreach(static::$_limits as $data) {
	    $keys = explode("|", $data['types']);
	    foreach($keys as $key) {
        $return[$key] = array();
	      foreach($data['values'] as $idx => $value) {
	        $name = array_search($idx, static::$_statMap);
	        $return[$key][$name] = $value; 
          
	      }
	    }
	  }
	  return $return;
	}
	
	public static function calcStat($stat, $value, $type, $asArray = false) {
    if(!in_array($type, static::$_typeMap)) {
			return false;
		}
		if(!in_array($stat, array_keys(static::$_statMap))) {
			return false;
		}
		
	  $perfect = static::$_limits[static::$_typeMap[$type]]['values'][static::$_statMap[$stat]];
		if($perfect == 0) {
		  return false;
		} else {
			$rating = round($value / $perfect * 100, 1);					
		}
		if($asArray == true) {
		  return array(
		    'rating' => $rating,
		    'perfect' => $perfect,
		    'value' => $value,
		  );
		}
		return "<span class='percent'>".$rating."%</span> of ".$perfect;
	}
	
	public static function maxStat($item) {
		if(!in_array($item->type, static::$_typeMap)) {
			return false;
		}
		if(!$item->attrs) {
			return false;
		}
		$idx = array_search($item->type, array_flip(static::$_typeMap));
		$ratings = array();
		$perfect = false;
		if($item->attrs) {
			foreach($item->attrs as $key => $value) {
				if(!in_array($key, array_keys(static::$_statMap))) {
					continue;
				}
				if(isset(static::$_typeMap[$item->type]) && isset(static::$_statMap[$key])) {
				  if(isset(static::$_limits[static::$_typeMap[$item->type]]['values'][static::$_statMap[$key]])) {
    				$perfect = static::$_limits[static::$_typeMap[$item->type]]['values'][static::$_statMap[$key]];				  				    
				  }
				}
				if(!$perfect) {
					// var_dump($item->type, $key); exit;
				} else {
          if(!is_array($value) && !is_object($value)) {
  					$rating = round($value / $perfect * 100, 1);					
  					$ratings[$key] = $rating;            
          }
				}
			}			
		}
		// if(count($ratings) > 0) {
		// 	$ratings['total'] = array_sum($ratings) / count($ratings);
		// }
		return $ratings;
	}
	
	public static function attr($attr, $value) {
		$text = static::$attributes['en'][$attr];
		if(!is_scalar($value)) {
			foreach($value->export() as $v) {
				$text = preg_replace('/\[v\]/', $v, $text, 1);
			}
			return $text;
		}
		return $return = str_replace('[v]', $value, $text);
	}
	
	public static function order($attrs) {
		$return = array();
		foreach(static::$attributes['en'] as $attr => $string) {
			if(isset($attrs[$attr])) {
				$return[$attr] = $attrs[$attr];
			}			
		}
		return $return;
	}
} // END class D3Up_Tool_Attributes