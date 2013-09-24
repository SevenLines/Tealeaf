Коллекции являются своего рода динамическим массивами. Я собираюсь рассмотреть работу с коллекциями 
на примере списков (List) и словарей (Dictionary).
Создадим обыкновенное консольное приложение
<pre class="brush: csharp">
using System; // подключим пространство имен для работы с онсновными типами и консолью
using System.Collections.Generic; // для работы с коллекциями
using System.Linq; // для использование встроенного языка Linq

namespace ConsoleApplication1
{
	class Program
	{
		static void Main(string[] args)
		{
            
		}
	}
}
</pre>
Опять же весь код ниже надо будет вписать в тело функции <b>static void Main(string[] args).</b>
<p>
В данном приложении я для ускорения процесса, "захардкодю" строку ввода, чтобы не вводить ее по 100 раз.
И хотя работать я собираюсь сегодня со списком чисел, я намерено добавлю паразитных элементов в строку.
<pre class="brush: csharp">
/* 
	чтобы положить чего то в строку совсем необязательно 
	запорашивать это "чего-то" от пользователя, можно явно указать строку
*/
String strNumbers = "123 bz 12, 53, asd 7 91 15";
</pre>
Чтобы разбить строку на подстроки, а тут в качестве разделителей используется не только пробелы но и запятые,
придется использовать усложненную версию функции <b>Split</b>
<pre class="brush: csharp">
// массив разделителей
Char[] separators = new Char[] { ' ', ',' };

/* 
	Создаем переменную для хранения списка строк, 
	полученных путем разбиения сторки strNumbers 
	разделителями из массива separators.

	Второй параметр устанавливаем на StringSplitOptions.RemoveEmptyEntries
	чтобы избежать появления пустых строк в массиве strNumbersArray,
	которые возникают если два разделителя стоят рядом (например два подряд идущих пробела) 
*/
String[] strNumbersArray = strNumbers.Split(separators, StringSplitOptions.RemoveEmptyEntries);
</pre>
<hr>
<h2>Списки. Тип List&#60;int&#62;</h2>
Так как нашей целью является изучить возможности работы со списками, необходимо этот список создать.
Для большинства объектов (типов) с которыми вы столкнетесь необходимо будет использование оператор new.
<pre class="brush: csharp">
/* 
	Данное предложение читается справа налево, т.е. 
	создать в памяти объект типа List&ltint&gt (список целых чисел),
	и установить numbers как ссылку на этот объект
*/
List&ltint&gtnumbers = new List&ltint&gt();
</pre>
Теперь этот список надо наполнить числами полученные преобразованием элементов массива <b>strNumbersArray</b> в числа.
Очевидно что не все элементы массива <b>strNumbersArray</b> являются числами, если вывести сейчас массив <b>strNumbersArray</b> на экран 
то мы увидим примерно следующую картину:
<div class="console">
123<br>
bz<br>
12<br>
53<br>
asd<br>
7<br>
91<br>
15<br>
</div>
Очевидно, что <span class="consoleIn">bz</span> и <span class="consoleIn">asd</span> не являются числами.
Для заполнения списка числами мы будем использовать цикл <b>foreach</b> внутри которого будет вызываться функция
<b>TryParse </b>которая позволяет проверить строку на ее возможность преобразования в число, если такая возможность
есть то в она возвращает true и во второй параметр передает результат преобразования.

<pre class="brush: csharp">
// проходим по всем подстрокам
foreach (Strig strNumber in strNumbersArray)
{
	int num;
	/*
		тут мы проверяем можно ли преобразовать строку в число
		если преобразование возможно то результат преобразования
		будет положен в переменную num, которую мы создали шагом выше
	*/
	if ( int.TryParse(strNumber, out num) == true )
	{
		numbers.Add(num);
	}
}
</pre>

<div class="note">
Функция объекта <b>int</b> по имени <b>TryParse</b> представляет собой функцию возвращающая сразу два значение 
<pre class="brush: csharp">
int.TryParse(strNumber, out num)
</pre>
Первое значение мы используем когда сравниваем значения функции с константой <b>true</b>
<pre class="brush: csharp">
// не обращаем внимание на многоточие
if ( int.TryParse( ... ) == true )
...
// можно было записать это и так выделив дополнительную переменную 
// для сохранения результата функции
bool tryParseResult = int.TryParse( ... );
if ( tryParseResult == true )
...
</pre>
Эта же функция в случае успешной конвертации возвращает еще одно значение, 
оно передается во второй параметр. Чтобы получить к нему доступ необходимо 
создать дополнительную переменную и передать ее в качестве второго параметра 
вместе с ключевым словом <b>out</b>:
<pre class="brush: csharp">
...
// создаем переменную для хранения результата преобразования
int num;
// пытаемся преобразовать строку some_string в число
if ( int.TryParse(some_string, out num) ) 
{
	// если преобразование было успешным то выводим на экран это число	
	Console.WriteLine(num);
} 
else 
{
	// в случае неудачи сообщим что данная строка не является числом	
	Console.WriteLine(some_string + " не является числом >_>");
}
</pre>
То есть должно быть очевидно, что если <b>some_string == "123"</b>, 
на консоле увидим:
<div class="console">
123
</div>
Если же <b>some_string == "фонарик"</b>, на консоле увидим:
<div class="console">
фонарик не является числом >_>
</div>
</div>
<p>
После выполнения всех этих операций список <b>numbers</b> будет содержать 
числа, (если быть точным, то с учетом того какую строку мы задали 
в списке будут числа <b>123, 12, 53, 7, 91, 15</b>, именно в таком порядке)
<p>
Теперь выведем их на экран
<pre class="brush: csharp">
// сообщим пользователю о том что собираемся показать все числа в списке
Console.WriteLine("Исходный список:");

// выведем список на экран
foreach(int number in numbers) Console.Write(number + " ");

/*
	так как фукнция Console.Write в отличие от Console.WriteLine 
	не переводит курсор на новую строку, то я вызову функцию Console.WriteLine 
	чтобы такое переход осуществить собственноручно
*/
Console.WriteLine();
</pre>
Упорядочивание элементов в C# -- милое дело, все делается в одну-две команды
<h4>Сортировка по возрастанию</h4>
<pre class="brush: csharp">
// функция Sort сортирует элементы списка в порядке возрастания
numbers.Sort();

// вывод на экран
Console.WriteLine("Упорядоченный по возрастанию:");
foreach(int number in numbers) Console.Write(number + " ");
Console.WriteLine();
</pre>

<h4>Сортировка по убыванию</h4>
<pre class="brush: csharp">
// сначала отсортируем по возрастанию 
numbers.Sort();
// а потом развернем список 
// вообще не самый эффективный способ, 
// но вполне пригодный для небольших списков
numbers.Reverse();

// вывод на экран
Console.WriteLine("Упорядоченный по возрастанию:");
foreach(int number in numbers) Console.Write(number + " ");
Console.WriteLine();
</pre>
<div class="note">
Более эффективным способом упорядочения списка по убыванию, заключается в явном указании функции сортировки:
<pre class="brush: csharp">
numbers.Sort( (num1, num2) => num2.CompareTo(num1) );
</pre>
Здесь используется лямбда-выражение, которым реализуется функция от двух параметров 
возвращающая<br>
<b>-1</b> если <b>num1 > num2</b>,<br>
<b>1</b> если <b>num1 < num2</b><br> 
<b>0</b> если они совпадают.
</div>
<h4>Количество элементов в списке</h4>
<pre class="brush: csharp">
Console.Write"Количество элементов в списке: ");
// используем свойстве списка count
Console.WriteLine(numbers.count);
</pre>

<h4>Минимальный элемент</h4>
<pre class="brush: csharp">
/*
	в отличие от количества элементов, под минимальный элемент
	лучше создать переменную, так как при каждом вызове функции Min
	этот элемент ищется заново
*/
int minimum = numbers.Min();

Console.Write("Минимальный элемент: ");
Console.WriteLine(minimum);
</pre>

<h4>Максимальный элемент</h4>
<pre class="brush: csharp">
/*
	и под максимальный элемент лучше создать переменную, 
	так как при каждом вызове функции Max
	этот элемент также ищется заново.
*/
int maximum = numbers.Max();

Console.Write("Максимальный элемент: ");
Console.WriteLine(maximum);
</pre>
<hr>
<h2>Словари. Тип Dictionary&#60;String, String&#62;</h2>
Словари позволяют нам хранить пары вида (ключ, значение). Наилучшим примером объекта типа словарь,
является, как бы это странно это не звучало, обычный словарь. Например русско-английский. Я продемонстрирую
как сделать словарь который будет переводить предложения не хуже печально известного Промта. 
<p>
Как и любой объект сложнее <b>int</b> (ну или <b>String</b>, <b>float</b>, <b>long</b> и т.п.), словарь надо создавать с помощью оператора <b>new</b>:
<pre class="brush: csharp">
Dictionary&lt;String, String&gt; dictionary = new Dictionary&lt;string, string&gt;();
/*
	не обязательно указывать тип явно можно написать и так
	var dictionary = new Dictionary&lt;string, string&gt;();
*/
</pre>

Теперь добавим несколько слов в наш словарь
<pre class="brush: csharp">
// первый параметр функции Add это ключ, второй - значение
dictionary.Add("яблоко", "apple");
dictionary.Add("мороженое", "icecream");
dictionary.Add("чай", "tea");
</pre>
Выводим содержимое словаря на экран
<pre class="brush: csharp">
foreach (var pair in dictionary)
{
	/*
	  Тут мы используем форматирование выводимого текста
	  {0} - будет заменено на второй параметр функции WriteLine (т.е на значение pair.Key)
	  {1} - будет заменено на третий параметр функции WriteLine (т.е на значение pair.Value)
	  
	  Аналогично можно добавить {2} - если у нас вдруг появиться какой-то третий параметр 
	*/	
	Console.WriteLine("{0} по-английски {1}", pair.Key, pair.Value);
}
</pre>
Добавим следующее приложение:
<pre class="brush: csharp">
String sentence = "Я пожалуй возьму яблоко, мороженое и чай";
</pre>
И воспользуемся нашим словарем для перевода (так как в нашем словаре только три слова,
следовательно и перевести мы сможем  только три слова, ну для начала и так не плохо :D 
<pre class="brush: csharp">
// сначала покажем исходное предложение
Console.WriteLine(sentence);

/*
	собственно тут и осуществляется перевод,
	для упрощения, я вместо того чтобы искать 
	слова из текста в словаре, будут искать 
	слова из словаря в тексте. 
	
	Нелогично, зато код во много раз проще,
	иначе бы мне пришлось разбивать текст 
	на слова, искать каждое слово в словаре,
	а потом еще эти слова уже склеивать обратно
	в предложение, что, вообще говоря, является
	нетривиальной задачей.
*/

foreach (var wordPair in dictionary)
{
	/*
	  Функция Replace ищет в строке для которой она вызывается
	  значение первого параметра и заменяет его значением второго параметра.
	  
	  В качестве результата  возвращает новую строку которая является
	  преобразованным предложением.
	  
	  Тут мы присваиваем значение функции самой строке, чтобы на следующей
	  итерации цикла уже использовалось новое предложение 
	  в котором часть слов уже переведена
	*/	 
	 sentence = sentence.Replace(wordPair.Key, wordPair.Value);
}

// вывод на экран переведенного предложения
Console.WriteLine(sentence);
</pre>
Ну и последним шагов приостанавливаем работу программы в ожидании нажатия любой клавиши
пользователем, иначе консолька автоматически закроется.
<pre class="brush: csharp">
// ожидаем нажатия любой клавиши пользователем
Console.ReadKey();
</pre>

<hr>
<h2>Результат работы:</h2>
<div class ="console">
Исходный список:<br>
123 12 53 7 91 15<br>
Упорядоченный по возрастанию:<br>
7 12 15 53 91 123 <br>
Упорядоченный по убыванию:<br>
123 91 53 15 12 7 <br>
Количество элементов: 6<br>
Минимальный элемент: 7<br>
Максимальный элемент: 123<br>
мороженое по-английски icecream<br>
чай по-английски tea<br>
яблоко по-английски apple<br>
Я пожалуй возьму яблоко, мороженое и чай<br>
Я пожалуй возьму apple, icecream и tea<br>
_
</div>
<hr>
<h2>Полный листинг:</h2>
<pre class="brush: csharp">
using System;
using System.Collections.Generic;
using System.Linq;


class Program
{
    static void Main(string[] args)
    {
        // чтобы положить чего то в строку совсем необязательно 
        // заправшивать чего-то от пользователя, можно явно указать строку
        String strNumbers = &quot;123 bz 12, 53, asd 7 91 15&quot;;

        // разбиваем строку запятыми и пробелами, и убираем за одно пустые строки
        Char[] separators = new Char[] { &apos; &apos;, &apos;,&apos; };
        String[] strNumbersArray = strNumbers.Split(separators, StringSplitOptions.RemoveEmptyEntries);

        List&lt;int&gt; numbers = new List&lt;int&gt;(); // создаем динамический список

        // проходим по всем подстрокам
        foreach (String strNumber in strNumbersArray)
        {
            int num;
            // тут мы проверяем можно ли преобразовать строку в число
            if (int.TryParse(strNumber, out num))
            {
                numbers.Add(num);
            }
        }

        Console.WriteLine(&quot;Исходный список:&quot;);
        foreach(int number in numbers) Console.Write(number + " ");
        Console.WriteLine();

        // функция Sort сортирует элменты массива в порядке возрастания
        numbers.Sort();
        
        Console.WriteLine(&quot;Упорядоченный по возрастанию:&quot;);
        foreach(int number in numbers) Console.Write(number + " ");
        // чтобы не слипалось со следующем выводом
        Console.WriteLine();

        // упорядочим список по убыванию
        numbers.Sort();
        numbers.Reverse();
        
        Console.WriteLine(&quot;Упорядоченный по убыванию:&quot;);
        foreach(int number in numbers) Console.Write(number + " ");
        Console.WriteLine();

		  Console.Write(&quot;Количество элементов: &quot;);
        Console.WriteLine(numbers.Count);

        int minimum = numbers.Min();
        Console.Write(&quot;Минимальный элемент: &quot;);
        Console.WriteLine(minimum);

        int maximum = numbers.Max();
        Console.Write(&quot;Максимальный элемент: &quot;);
        Console.WriteLine(maximum);

        Dictionary&lt;String, String&gt; dictionary = new Dictionary&lt;string, string&gt;();
        dictionary.Add(&quot;яблоко&quot;, &quot;apple&quot;);
        dictionary.Add(&quot;мороженое&quot;, &quot;icecream&quot;);
        dictionary.Add(&quot;чай&quot;, &quot;tea&quot;);

        dictionary = dictionary.OrderBy(pair =&gt; pair.Key).ToDictionary(pair =&gt; pair.Key, pair =&gt; pair.Value);

        foreach (var pair in dictionary)
        {
            Console.WriteLine(&quot;{0} по-английски {1}&quot;, pair.Key, pair.Value);
        }


        String sentence = &quot;Я пожалуй возьму яблоко, мороженое и чай&quot;;

        Console.WriteLine(sentence);
        foreach (var wordPair in dictionary)
        {
            sentence = sentence.Replace(wordPair.Key, wordPair.Value);
        }
        Console.WriteLine(sentence);
		

        Console.ReadKey();
    }
}
</pre>