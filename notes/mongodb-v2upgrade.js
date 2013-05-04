// Inverse how builds are hidden, so we can use a sparse indexes for searching.
db.builds.update({}, {$set: {public: true}}, {multi: true});
db.builds.update({private: true}, {$set: {public: false}, $unset: {private: 1}}, {multi: true});