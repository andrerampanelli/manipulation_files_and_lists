# Manipulation files and recursive function

#### To run api
> make setup

#### Routes
> GET "/"
>> Shows Lumen version

> POST "/scripts"
>> Write a file based on json body received, organizing tasks, such as:

```JSON
{
  "filename": "myscript.sh",
  "tasks": [
    {
      "name": "rm",
      "command": "rm -f /tmp/test",
      "dependencies": [
        "cat"
      ]
    },
    {
      "name": "cat",
      "command": "cat /tmp/test",
      "dependencies": [
        "chown",
        "chmod"
      ]
    },
    {
      "name": "touch",
      "command": "touch /tmp/test"
    },
    {
      "name": "chmod",
      "command": "chmod 600 /tmp/test",
      "dependencies": [
        "touch"
      ]
    },
    {
      "name": "chown",
      "command": "chown root:root /tmp/test",
      "dependencies": [
        "touch"
      ]
    }
  ]
}
```
