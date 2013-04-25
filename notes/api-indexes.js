// Builds
db.builds.ensureIndex({public: 1, 'stats.ehp': -1}, {sparse: true});
db.builds.ensureIndex({public: 1, 'stats.dps': -1}, {sparse: true});
db.builds.ensureIndex({public: 1, class: 1, 'skills': 1}, {sparse: true});


db.builds.dropIndex({public: 1, class: 1});
db.builds.ensureIndex({public: 1, class: 1, 'stats.dps': -1}, {sparse: true});
db.builds.ensureIndex({public: 1, class: 1, 'stats.ehp': -1}, {sparse: true});


