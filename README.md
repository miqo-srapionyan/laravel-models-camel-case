## laravel-models-camel-case
Simply camelCase Laravel Model attributes and relationships. <br>

## Installation
```shell
composer require miqo/laravel-models-camel-case
```
## Usage
Just use trait in your Laravel Models
```injectablephp
use Miqo\LaravelModelsCamelCase\Traits\AttributesCamelCase;

class Users extends Model {
    use AttributesCamelCase;
}
```

This trait overrides Laravel Model's some of default methods.
`getAttribute`, `setAttribute`, `toArray`

Now you can use camel case attributes for saving as well as gor getting.<br>
For example you have `users` table, and `first_name`, `last_name` columns.
```injectablephp
// When saving
$user = new User();
$user->firstName = 'John'; // instead of $user->first_name
$user->lastName = 'Doe'; // instead of $user->last_name
$user->save();

// When creating
$user = new User([
    'firstName' => 'John', // instead of first_name
    'lastName'  => 'Doe', // instead of last_name
]);
$user->save();

// When getting
$user = User::find(1);
// instead of $user->first_name, $user->last_name
echo $user->firstName.' '.$user->lastName; // John Doe
```
And you can still use the old way as well, as mixed it
```injectablephp
// When saving
$user = new User();
$user->first_name = 'John';
$user->last_name = 'Doe';
$user->save();

// When creating
$user = new User([
    'first_name' => 'John',
    'last_name'  => 'Doe', 
]);
$user->save();

// When getting
$user = User::find(1);
echo $user->first_name.' '.$user->last_name; // John Doe

// Mixed
$user = new User();
$user->firstName = 'John';
$user->last_name = 'Doe';
$user->save();
```


