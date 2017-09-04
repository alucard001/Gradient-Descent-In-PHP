Gradient Descent implementation in PHP

An implementation of Gradient Descent (GD) in this example: https://github.com/llSourcell/GradientDescentExample

**Points to note**

- This is a 2 columns dataset.  The data.csv file is exactly the same as above URL
- So there is no matmul() or dot() stuff.
- Yes I know there is a thing call NumPHP, but I just want to practise my understanding of GD only.  :)
- There may be a better way to optimize.  But since my objective is to learn stuff, there are a lot of comments inside the code to help someone (including me) out.
- There are 2 versions: gd.php and gd-func.php
- gd-func.php is the exact implementation of the above link, only modify the parameters structure
- gd.php is a merge, everything-inside-one-big-giant-thing version.
- The reason of having gd.php, to me, is that doing this can make me clear how every variable flows and updated.
- Using the functions seems much clear than non-functions, but I need to jump back-and-forth to see how things work, which I have difficulties with that.

After implementing it in PHP, I understand that actually, using Python in such case is much better.

Although PHP can do the same operations, while implementing it, I found that PHP is not very good at handling complex operations, which is an advantage of Python.

Therefore, each programming language has its own objective.  We need to use the language which is best fit the problem.

Probably we can do the same thing in Javascript. :)

**How To Run?**

Open your browser and simply points to the file (gd.php / gd-func.php).

Remember to put data.csv inside the same directory as gd.php/gd-func.php (which has been done already).

**Output**

Both php will generate:

`Starting gradient descent at b = 0, m = 0, error = 5565.1078344832
Running...
After 1000 iterations b = 0.088936519937413, m = 1.4777440851894, error = 112.67576414361`