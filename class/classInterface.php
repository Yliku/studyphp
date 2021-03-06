<?php 
//团队合作之——接口interface和抽象类abstract
//类是对象的模板，而接口是类的模板，接口可以被继承，但不能被直接实例化，和类是不一样的
//接口里面只能是空的方法，而抽象类的方法可以具体实现

// 类的接口、模板
interface Person{
	public function eat();		//必须为空方法，注意接口的函数后面没有花括号，而是分号！！！
	public function sleep();		//必须为空方法，注意接口的函数后面没有花括号，而是分号！！！
}
class Man implements Person{		//类Man实现了该接口
	public function eat(){
		echo '接口之：男人的一日三餐<br />';		//根据接口，必需实现方法eat
	}
	public function sleep(){
		echo '接口之：凌晨三点才睡觉<br />';		//根据接口，必需实现方法sleep
	}
	public function study(){
		echo '接口之测试：新增方法是否可行<br />';	//使用接口定义的类可以新增方法！!!
	}
}
//模拟业务需要，应用上面的内容	 
//类也是一种类型，可以作为参数的类型提示，同样接口也可以作为参数的类型提示来限制参数的传递，这种很常用！！！
class L{
	public static function factory(Person $user){
		return $user;
	}
}
$user1 = L::factory(new Man() );
//....融入很多业务逻辑代码，能这么大胆放心地使用是因为我们知道$user使用了接口，肯定实现了接口里面的函数
$user1->eat();	
//....融入很多业务逻辑代码
$user1->sleep();
$user1->study();
//如果我们要将工厂（factory）里面的男人（Man）换成女人，我们只要再定义一个类Woman再进行调用即可
class Woman implements Person{
	public function eat(){
		echo '接口之：女人的一日三餐加零食<br />';
	}
	public function sleep(){
		echo '接口之：12点前睡觉<br /><br />';
	}
}
$user2 = L::factory(new Woman() );
$user2->eat();	
$user2->sleep();
//接口的使用对于管理代码和团队合作非常的必需！！因为接口规定了一种规范

//接口 的继承
interface Ia{
	const NUM='接口的常量，需静态调用::<br />';		//接口居然可定义常量，而且还不是空的.......
	function eat();			//注意接口不实现方法，空方法，不需要花括号，而且空方法最后得加分号！！！
}
interface Ib{
	function sleep();
}
interface AB extends Ia,Ib{}	//接口的继承，继承Ia,Ib
class Test implements AB{		//定义一个使用接口的类Test
//但实际我们不经常用接口的继承，我们更多会直接使用   class Test implements Ia,Ib{} 来直接定义使用接口的类
	function eat(){		echo '接口继承之：吃炸鸡啤酒<br />';	}
	function sleep(){	echo '接口继承之：学代码不睡觉<br /><br />';	}
}
$test1 = new Test();
echo $test1::NUM;
$test1->eat();
$test1->sleep();


//抽象类，方法可具体实现
abstract class A2{		//抽象类顾名思义由 abstract + class组成
	public function holiday(){	//具体实现的方法
		echo '抽象类——可具体实现方法<br />';
		echo '五一休息<br />';
	}
	public function eat(){}		//空方法
	public function sleep(){}		//空方法
}
class Test2 extends A2{
	public function eat(){		//必须实现空方法
		$this->holiday();
		echo '吃烧饼<br />';
	}		
	public function sleep(){		//必须实现空方法
		echo '学代码，不睡觉<br /><br />';
	}		
}
$test2=new Test2();
$test2->eat();
$test2->sleep();

 ?>




 <!--
 抽象类作用：其一，为团队定义一个规范，其二，类似多态的向上转型。
这么说吧 接口和抽象都是团队合作用的 毕竟一个大项目需要十几甚至几十个人来完成 每个人的编程（比如取名）的习惯都不一样 有了这个 大家都有一个统一的标准 boss管理起来就方便了 一两个人的小项目是用不上这些的，之所以写成抽象类，并非必须用抽象类，用普通类也可以继承。用抽象类是给其他“人”看的，而不是给计算机看的，又或者说这是一种规范
你的项目经理给你分配做功能的时候只规定了接口或者抽象类~，然后你就得 去实现或继承这些方法。他不管你是什么方法实现这些功能，只看最后实现的抽象类是不是符合他要求的。好处是在项目初期设计的时候 只考虑结果 不考虑过程

问你个问题，你知道什么是“东西”吗？什么是“物体”吗？ 
“麻烦你，小王。帮我把那个东西拿过来好吗” 
在生活中，你肯定用过这个词－－东西。 
小王：“你要让我帮你拿那个水杯吗？” 
你要的是水杯类的对象。而东西是水杯的父类。通常东西类没有实例对象，但我们有时需要东西的引用指向它的子类实例。 

你看你的房间乱成什么样子了，以后不要把东西乱放了，知道么？ 
又是东西，它是一个数组。而数组中的元素都是其子类的实例。 

上面讲的只是子类和父类。而没有说明抽象类的作用。抽象类是据有一个或多个抽象方法的类，必须声明为抽象类。抽象类的特点是，不能创建实例。 
这些该死的抽象类，也不知道它有什么屁用。我非要把它改一改不可。把抽象类中的抽象方法都改为空实现。也就是给抽象方法加上一个方法体，不过这个方法体是空的。这回抽象类就没有抽象方法了。它就可以不在抽象了。 
当你这么尝试之后，你发现，原来的代码没有任何变化。大家都还是和原来一样，工作的很好。你这回可能更加相信，抽象类根本就没有什么用。但总是不死心，它应该有点用吧，不然创造Java的这伙传说中的天才不成了傻子了吗？ 
接下来，我们来写一个小游戏。俄罗斯方块！我们来分析一下它需要什么类？
我知道它要在一个矩形的房子里完成。这个房子的上面出现一个方块，慢慢的下落，当它接触到地面或是其它方块的尸体时，它就停止下落了。然后房子的上面又会出现一个新的方块，与前一个方块一样，也会慢慢的下落。在它还没有死亡之前，我可以尽量的移动和翻转它。这样可以使它起到落地时起到一定的作用，如果好的话，还可以减下少几行呢。这看起来好象人生一样，它在为后来人努力着。
当然，我们不是真的要写一个游戏。所以我们简化它。我抽象出两个必须的类，一个是那个房间，或者就它地图也行。另一个是方块。我发现方块有很多种，数一下，共6种。它们都是四个小矩形构成的。但是它们还有很多不同，例如：它们的翻转方法不同。先把这个问题放到一边去，我们回到房子这个类中。
房子上面总是有方块落下来，房子应该有个属性是方块。当一个方块死掉后，再创建一个方块，让它出现在房子的上面。当玩家要翻转方法时，它翻转的到底是哪个方块呢？当然，房子中只有一个方块可以被翻转，就是当前方块。它是房子的一个属性。那这个属性到底是什么类型的呢？方块有很多不同啊，一共有6种之多，我需要写六个类。一个属性不可能有六种类型吧。当然一个属性只能有一种类型。
我们写一个方块类，用它来派生出6个子类。而房子类的当前方块属性的类型是方块类型。它可以指向任何子类。但是，当我调用当前方块的翻转方法时，它的子类都有吗？如果你把翻转方法写到方块类中，它的子类自然也就有了。可以这六种子类的翻转方法是不同的。我们知道'田'方块，它只有一种状态，无论你怎么翻转它。而长条的方块有两种状态。一种是‘－’，另一种是‘｜’。这可怎么办呢？我们知道Java的多态性，你可以让子类来重写父类的方法。也就是说，在父类中定义这个方法，子类在重写这个方法。
那么在父类的这个翻转方法中，我写一些什么代码呢？让它有几种状态呢？因为我们不可能实例化一个方块类的实例，所以它的翻转方法中的代码并不重要。而子类必须去重写它。那么你可以在父类的翻转方法中不写任何代码，也就是空方法。
我们发现，方法类不可能有实例，它的翻转方法的内容可以是任何的代码。而子类必须重写父类的翻转方法。这时，你可以把方块类写成抽象类，而它的抽象方法就是翻转方法。当然，你也可以把方块类写为非抽象的，也可以在方块类的翻转方法中写上几千行的代码。但这样好吗？难道你是微软派来的，非要说Java中的很多东西都是没有用的吗？
当我看到方块类是抽象的，我会很关心它的抽象方法。我知道它的子类一定会重写它，而且，我会去找到抽象类的引用。它一定会有多态性的体现。
但是，如果你没有这样做，我会认为可能会在某个地方，你会实例化一个方块类的实例，但我找了所有的地方都没有找到。最后我会大骂你一句，你是来欺骗我的吗，你这个白痴。
把那些和“东西”差不多的类写成抽象的。而水杯一样的类就可以不是抽象的了。当然水杯也有几千块钱一个的和几块钱一个的。水杯也有子类，例如，我用的水杯都很高档，大多都是一次性的纸水杯。
记住一点，面向对象不是来自于Java，面向对象就在你的生活中。而Java的面向对象是方便你解决复杂的问题。这不是说面向对象很简单，虽然面向对象很复杂，但Java知道，你很了解面向对象，因为它就在你身边。
-->