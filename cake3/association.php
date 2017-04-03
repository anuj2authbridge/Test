one to one 	hasOne 	A user has one profile.
one to many 	hasMany 	A user can have multiple articles.
many to one 	belongsTo 	Many articles belong to a user.
many to many 	belongsToMany 	Tags belong to many articles.


belongsTo

$this->belongsTo('Authors', [
    'className' => 'Publishing.Authors',
    'foreignKey' => 'authorid',
    'propertyName' => 'person'
]);

hasMany

$this->hasMany('SubCategories', [
            'className' => 'Categories'
        ]);
Diffrent way to declare association
class PostsTable extends Table
{
    public function initialize(array $config)
    {
       $this->addAssociations([
           'belongsTo' => [
               'Users' => ['className' => 'App\Model\Table\UsersTable']
           ],
           'hasMany' => ['Comments'],
           'belongsToMany' => ['Tags']
       ]);
    }
}


belongsToMany

Three database tables are required for a BelongsToMany association. 
In the example above we would need tables for articles, tags and articles_tags. 
The articles_tags table contains the data that links tags and articles together. 
The joining table is named after the two tables involved, separated with an underscore by convention. 
In its simplest form, this table consists of article_id and tag_id.

belongsToMany requires a separate join table that includes both model names.

ex-: Article belongsToMany Tag 	articles_tags.id, articles_tags.tag_id, articles_tags.article_id

We can define the belongsToMany association in both our models as follows:

// In src/Model/Table/ArticlesTable.php
class ArticlesTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsToMany('Tags');
    }
}

// In src/Model/Table/TagsTable.php
class TagsTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsToMany('Articles');
    }
}

// In src/Model/Table/ArticleTagsTable.php
class ArticleTagsTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Articles');
        $this->belongsTo('Tags');
    }
}
