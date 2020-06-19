<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Promos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categoryChildren = (new Category())
            ->setName('Children')
            ->setDescription('Children\'s books');
        $manager->persist($categoryChildren);
        $categoryFiction = (new Category())
            ->setName('Fiction')
            ->setDescription('Fiction\'s books');
        $manager->persist($categoryFiction);


        $data = ['Pride and Prejudice by Jane Austen (54360)','Alice\'s Adventures in Wonderland by Lewis Carroll (39564)','Calculus Made Easy by Silvanus P. Thompson (35339)','The Works of Edgar Allan Poe, The Raven Edition by Edgar Allan Poe (27887)','Ion by Plato (26170)','Frankenstein; Or, The Modern Prometheus by Mary Wollstonecraft Shelley (25298)','Moby Dick; Or, The Whale by Herman Melville (24074)','The Adventures of Sherlock Holmes by Arthur Conan Doyle (22394)','The Strange Case of Dr. Jekyll and Mr. Hyde by Robert Louis Stevenson (20901)','A Tale of Two Cities by Charles Dickens (20451)','The Yellow Wallpaper by Charlotte Perkins Gilman (20227)','The Importance of Being Earnest: A Trivial Comedy for Serious People by Oscar Wilde (19382)','Et dukkehjem. English by Henrik Ibsen (18745)','The Adventures of Tom Sawyer by Mark Twain (17614)','Treasure Island by Robert Louis Stevenson (16315)','The Picture of Dorian Gray by Oscar Wilde (16097)','A Modest Proposal by Jonathan Swift (15972)','Little Women by Louisa May Alcott (15839)','Great Expectations by Charles Dickens (15485)','Metamorphosis by Franz Kafka (15184)','Walden, and On The Duty Of Civil Disobedience by Henry David Thoreau (14932)','Adventures of Huckleberry Finn by Mark Twain (14780)','The Call of the Wild by Jack London (14734)','A Christmas Carol in Prose; Being a Ghost Story of Christmas by Charles Dickens (14373)','A Journal of the Plague Year by Daniel Defoe (14211)','War and Peace by graf Leo Tolstoy (13224)','Grimms\' Fairy Tales by Jacob Grimm and Wilhelm Grimm (13138)','Peter Pan by J. M. Barrie (13082)','Dracula by Bram Stoker (12914)','Beowulf: An Anglo-Saxon Epic Poem (12864)','Ulysses by James Joyce (12648)','Emma by Jane Austen (12374)','Anthem by Ayn Rand (12332)','Jane Eyre: An Autobiography by Charlotte Brontë (12240)','The Souls of Black Folk by W. E. B. Du Bois (12116)','Il Principe. English by Niccolò Machiavelli (12095)','The Count of Monte Cristo, Illustrated by Alexandre Dumas (12051)','Symbolic Logic by Lewis Carroll (11597)','The Hound of the Baskervilles by Arthur Conan Doyle (11537)','Anne of Green Gables by L. M. Montgomery (10884)','The Wonderful Wizard of Oz by L. Frank Baum (10521)','Tractatus Logico-Philosophicus by Ludwig Wittgenstein (10498)','The Secret Garden by Frances Hodgson Burnett (9960)','Dubliners by James Joyce (9804)','Letters of a Radio-Engineer to His Son by John Mills (9577)','Index of Project Gutenberg Works on Black History by Various (9521)','Heart of Darkness by Joseph Conrad (9466)','The Scarlet Letter by Nathaniel Hawthorne (9449)','The Republic by Plato (9213)','Personal Memoirs of U. S. Grant, Complete by Ulysses S. Grant (9145)','The Brothers Karamazov by Fyodor Dostoyevsky (9132)','Prestuplenie i nakazanie. English by Fyodor Dostoyevsky (8974)','Wuthering Heights by Emily Brontë (8697)','Uncle Tom\'s Cabin by Harriet Beecher Stowe (8470)','The War of the Worlds by H. G. Wells (8333)','A Study in Scarlet by Arthur Conan Doyle (8309)','Siddhartha by Hermann Hesse (8056)','The Iliad by Homer (7806)','The Kama Sutra of Vatsyayana by Vatsyayana (7759)','The Prophet by Kahlil Gibran (7732)','The Awakening, and Selected Short Stories by Kate Chopin (7707)','Also sprach Zarathustra. English by Friedrich Wilhelm Nietzsche (7684)','The Sign of the Four by Arthur Conan Doyle (7592)','Pygmalion by Bernard Shaw (7534)','Les Misérables by Victor Hugo (7407)','The Time Machine by H. G. Wells (7211)','The Prince and the Pauper by Mark Twain (7208)','The Jungle Books by Rudyard Kipling (7175)','A Pickle for the Knowing Ones by Timothy Dexter (7070)','The Mysterious Affair at Styles by Agatha Christie (6849)','Leviathan by Thomas Hobbes (6778)','Oliver Twist by Charles Dickens (6664)','Narrative of the Life of Frederick Douglass, an American Slave by Frederick Douglass (6653)','Essays of Michel de Montaigne — Complete by Michel de Montaigne (6643)','The Memoirs, Correspondence, and Miscellanies, From the Papers of Thomas Jefferson by Jefferson (6485)','Anna Karenina by graf Leo Tolstoy (6392)','Meditations by Emperor of Rome Marcus Aurelius (6238)','An Index of The Divine Comedy by Dante by Dante Alighieri (6199)','Beyond Good and Evil by Friedrich Wilhelm Nietzsche (6030)','The Life and Adventures of Robinson Crusoe by Daniel Defoe (6010)','Don Quixote by Miguel de Cervantes Saavedra (5940)','The Devil\'s Dictionary by Ambrose Bierce (5922)','A History of Epidemics in Britain, Volume 1 (of 2) by Charles Creighton (5907)','Simple Sabotage Field Manual by United States. Office of Strategic Services (5901)','Sense and Sensibility by Jane Austen (5891)','Baron Trump\'s Marvellous Underground Journey by Ingersoll Lockwood (5771)','Frankenstein; Or, The Modern Prometheus by Mary Wollstonecraft Shelley (5748)','David Copperfield by Charles Dickens (5581)','The Odyssey by Homer (5565)','The Slang Dictionary: Etymological, Historical and Andecdotal by John Camden Hotten (5554)','Gulliver\'s Travels into Several Remote Nations of the World by Jonathan Swift (5525)','Candide by Voltaire (5522)','The Decameron of Giovanni Boccaccio by Giovanni Boccaccio (5415)','Complete Original Short Stories of Guy De Maupassant by Guy de Maupassant (5361)','The Tale of Peter Rabbit by Beatrix Potter (5291)','The Wonderful Wizard of Oz by L. Frank Baum (5282)','The Complete Works of William Shakespeare by William Shakespeare (5252)','The Happy Prince, and Other Tales by Oscar Wilde (5228)','Leaves of Grass by Walt Whitman (5228)','The Masque of the Red Death by Edgar Allan Poe (5206)'];

        for($i=0; $i<100; $i++) {
            $parts = explode(' by ', $data[$i]);
            $book = (new Book())
                ->setName($parts[0])
                ->setDescription($data[$i])
                ->setPrice((rand (50*10, 150*10) / 10))
                ->setImage('image_'.rand (1,20).'.jpg')
                ->setRate(rand (1,5))
                ->setAuthor(isset($parts[1])? explode('(', $parts[1])[0] : '')
                ->setCategory($i%2 == 1 ? $categoryChildren : $categoryFiction);
            $manager->persist($book);
        }

        $promo1 = (new Promos())
            ->setCategoryId(1)
            ->setActive(1)
            ->setDiscount(10)
            ->setItemCount(5)
            ->setPriority(1);
        $manager->persist($promo1);

        $promo2 = (new Promos())
            ->setActive(1)
            ->setDiscount(5)
            ->setItemCount(10)
            ->setPriority(1);
        $manager->persist($promo2);

        $promo3 = (new Promos())
            ->setCode('xyz')
            ->setActive(1)
            ->setDiscount(10)
            ->setItemCount(0)
            ->setPriority(1);
        $manager->persist($promo3);

        $manager->flush();
    }
}
