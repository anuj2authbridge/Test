Question

I have some content that contains a token string in the form
$string_text = '[widget_abc]This is some text. This is some text, etc...';
And I want to pull all the text after the first ']' character
So the returned value I'm looking for in this example is:
This is some text. This is some text, etc...


Answer

preg_match("/^.+?\](.+)$/is" , $string_text, $match);
echo trim($match[1]);

preg_match(param1, param2, param3) is a function that allows you to match a single case scenario of a regular expression that you're looking for

param1 = "/^.+?](.+?)$/is"

"//" is what you put on the outside of your regular expression in param1

the i at the end represents case insensitive (it doesn't care if your letters are 'a' or 'A')

s - allows your script to go over multiple lines

^ - start the check from the beginning of the string

$ - go all the way to end of the string

. - represents any character

.+ - at least one or more characters of anything

.+? - at least one more more characters of anything until you reach

.+?] - at least one or more characters of anything until you reach ] (there is a backslash before ] because it represents something in regular expressions - look it up)

(.+)$ - capture everything after ] and store it as a seperate element in the array defined in param3

param2 = the string that you created.
