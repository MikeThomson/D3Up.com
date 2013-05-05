use com_d3up;
db.builds.aggregate([
	{
		$match: {
			passives: { $size : 3 }
		}
	},
	{
		$unwind: '$passives'
	},
	{
		$group: {
			_id: {
				class: '$class',
				passive: '$passives'
			},
			count: {$sum: 1}
		}
	},
	{
		$sort: {
			count: 1
		}
	}
]);