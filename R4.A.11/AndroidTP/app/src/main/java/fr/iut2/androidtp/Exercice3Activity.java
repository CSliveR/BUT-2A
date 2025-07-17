package fr.iut2.androidtp;

import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.exercice3Data.Jeu;
import fr.iut2.androidtp.exercice3Data.Resultat;

public class Exercice3Activity extends AppCompatActivity {
    private LinearLayout layoutOrdi;
    private LinearLayout layoutJoueur;
    private TextView resultatView;
    private LinearLayout layoutStatistic;
    private Jeu jeu;
    private Resultat resultat;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_exercice3);
        layoutOrdi = findViewById(R.id.exercice3_layoutMainOrdi);
        layoutJoueur = findViewById(R.id.exercice3_layoutMainJoueur);
        resultatView = findViewById(R.id.exercice3_resulatView);
        layoutStatistic = findViewById(R.id.exercice3_layoutStatistic);
        resultat = new Resultat();

        layoutJoueur.findViewWithTag("exercice3_imgPapier").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Jeu();
                jeu.setMainJoueur(Jeu.PAPIER);
                jeuShifumi();
            }
        });

        layoutJoueur.findViewWithTag("exercice3_imgCaillou").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Jeu();
                jeu.setMainJoueur(Jeu.CAILLOUX);
                jeuShifumi();
            }
        });

        layoutJoueur.findViewWithTag("exercice3_imgCiseaux").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Jeu();
                jeu.setMainJoueur(Jeu.CISEAUX);
                jeuShifumi();
            }
        });
    }

    public void jeuShifumi(){
        layoutOrdi.findViewWithTag("exercice3_imgCaillou").setVisibility(View.INVISIBLE);
        layoutOrdi.findViewWithTag("exercice3_imgCiseaux").setVisibility(View.INVISIBLE);
        layoutOrdi.findViewWithTag("exercice3_imgPapier").setVisibility(View.INVISIBLE);

        if(jeu.getMainOrdinateur() == Jeu.CAILLOUX){
            layoutOrdi.findViewWithTag("exercice3_imgCaillou").setVisibility(View.VISIBLE);
        }else if(jeu.getMainOrdinateur() == Jeu.CISEAUX){
            layoutOrdi.findViewWithTag("exercice3_imgCiseaux").setVisibility(View.VISIBLE);
        }else{
            layoutOrdi.findViewWithTag("exercice3_imgPapier").setVisibility(View.VISIBLE);
        }

        if(jeu.joueurGagne()){
            resultatView.setText(R.string.exercice3_victoire);
            resultat.addVictoire();
            TextView victoiresTextView = layoutStatistic.findViewWithTag("exercice3_nbVictoires");
            victoiresTextView.setText(String.valueOf(resultat.getNombreVictoire()));
        }else if(jeu.egalite()){
            resultatView.setText(R.string.exercice3_egalite);
            resultat.addEgalite();
            TextView egalitesTextView = layoutStatistic.findViewWithTag("exercice3_nbEgalites");
            egalitesTextView.setText(String.valueOf(resultat.getNombreEgalite()));
        } else{
            resultatView.setText(R.string.exercice3_defaite);
            resultat.addDefaite();
            TextView defaitesTextView = layoutStatistic.findViewWithTag("exercice3_nbDefaites");
            defaitesTextView.setText(String.valueOf(resultat.getNombreDefaite()));
        }
    }
}
