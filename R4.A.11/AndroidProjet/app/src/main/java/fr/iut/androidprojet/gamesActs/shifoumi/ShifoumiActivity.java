package fr.iut.androidprojet.gamesActs.shifoumi;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;
import fr.iut.androidprojet.StatsActivity;
import fr.iut.androidprojet.gamesModels.shifoumi.Shifoumi;
import fr.iut.androidprojet.gamesModels.shifoumi.ShifoumiResult;

public class ShifoumiActivity extends MotherActivity {
    private LinearLayout layoutOrdi;
    private LinearLayout layoutJoueur;
    private TextView resultatView;
    private LinearLayout layoutStatistic;
    private Shifoumi jeu;
    private ShifoumiResult resultat;
    private int score;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_shifoumi);
        layoutOrdi = findViewById(R.id.layoutMainOrdi);
        layoutJoueur = findViewById(R.id.layoutMainJoueur);
        resultatView = findViewById(R.id.resulatView);
        layoutStatistic = findViewById(R.id.layoutStatistic);
        resultat = new ShifoumiResult();

        layoutJoueur.findViewWithTag("imgPapier").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Shifoumi();
                jeu.setMainJoueur(Shifoumi.PAPIER);
                jeuShifoumi();
            }
        });

        layoutJoueur.findViewWithTag("imgCaillou").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Shifoumi();
                jeu.setMainJoueur(Shifoumi.CAILLOUX);
                jeuShifoumi();
            }
        });

        layoutJoueur.findViewWithTag("imgCiseaux").setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                jeu = new Shifoumi();
                jeu.setMainJoueur(Shifoumi.CISEAUX);
                jeuShifoumi();
            }
        });
    }

    public void jeuShifoumi(){
        layoutOrdi.findViewWithTag("imgCaillou").setVisibility(View.INVISIBLE);
        layoutOrdi.findViewWithTag("imgCiseaux").setVisibility(View.INVISIBLE);
        layoutOrdi.findViewWithTag("imgPapier").setVisibility(View.INVISIBLE);

        if(jeu.getMainOrdinateur() == Shifoumi.CAILLOUX){
            layoutOrdi.findViewWithTag("imgCaillou").setVisibility(View.VISIBLE);
        }else if(jeu.getMainOrdinateur() == Shifoumi.CISEAUX){
            layoutOrdi.findViewWithTag("imgCiseaux").setVisibility(View.VISIBLE);
        }else{
            layoutOrdi.findViewWithTag("imgPapier").setVisibility(View.VISIBLE);
        }

        if(jeu.joueurGagne()){
            resultatView.setText(R.string.shifoumi_victoire);
            resultat.addVictoire();
            TextView victoiresTextView = layoutStatistic.findViewWithTag("nbVictoires");
            victoiresTextView.setText(String.valueOf(resultat.getNombreVictoire()));
        }else if(jeu.egalite()){
            resultatView.setText(R.string.shifoumi_egalite);
            resultat.addEgalite();
            TextView EgalitesTextView = layoutStatistic.findViewWithTag("nbEgalites");
            EgalitesTextView.setText(String.valueOf(resultat.getNombreEgalite()));
        } else{
            resultatView.setText(R.string.shifoumi_defaite);
            resultat.addDefaite();
            TextView defaitesTextView = layoutStatistic.findViewWithTag("nbDefaites");
            defaitesTextView.setText(String.valueOf(resultat.getNombreDefaite()));
        }

        score = resultat.getNombreVictoire() - resultat.getNombreDefaite();
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Log.d("ShifoumiActivity", "Retour à l'activité précédente");

        // Sauvegarder le score dans SharedPreferences
        SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        Log.d("ShifoumiActivity", "Sauvegarde du score : " + score);
        editor.putInt("SCORE_SHIFOUMI", score);  // Enregistrer le score avec une clé spécifique
        editor.apply();  // Appliquer les changements

        // Lancer l'activité des statistiques
        Log.d("ShifoumiActivity", "Score à envoyer : " + score);
        Intent statsActivityIntent = new Intent(ShifoumiActivity.this, StatsActivity.class);
    }
}
