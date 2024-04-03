import java.util.regex.*;
import java.io.*;
import java.util.Scanner;

/** mini Regex en Java
 * @author Bruno LEGRIX
 * @version 2 du 05/05/2020
 */

public class Regex
{
	// 1er argument la regex, le second le nom du fichier texte
	// ATTENTION aucune sécurité sur args[]
	public static void main(String[] args)
	{
	
		if (args.length<2)
		{
			System.out.println(  "Il faut 2 arguments :\n"
			                   + "\t1er  argument la regex,\n"
			                   + "\t2ème argument le nom du fichier.");
			return;
		}
		
		Pattern    patternCompile = Pattern.compile(args[1]);
		FileReader fr     ;
		Scanner    sc     ;
		String     ligne  ;
		Matcher    matcher;

		try
		{
			fr = new FileReader(args[0]);
			sc = new Scanner(fr);
			while(sc.hasNext())
			{
				ligne   = sc.nextLine();
				matcher = patternCompile.matcher(ligne);
				while( matcher.find() )
				{
					System.out.println(ligne + " " + matcher.group() 
					                         + " " + matcher.start()
					                         + " " + matcher.end()
					                         + " " + matcher.groupCount() );
				}
			}
			fr.close();
		}
		catch(Exception e)
		{
			e.printStackTrace();
		}
	}
} 
