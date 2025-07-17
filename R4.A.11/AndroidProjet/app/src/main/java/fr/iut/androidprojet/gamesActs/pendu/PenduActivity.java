package fr.iut.androidprojet.gamesActs.pendu;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;
import fr.iut.androidprojet.gamesModels.pendu.Pendu;
import fr.iut.androidprojet.gamesModels.pendu.CreateListMots;

public class PenduActivity extends MotherActivity {
    private Pendu pendu;
    private TextView motCacheView, nbEssaisView, lettresEssayeesView, messageView;
    private EditText lettreInput;
    private Button btnEssayer, btnRestart, btnQuitter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pendu);

        motCacheView = findViewById(R.id.hide_word_text);
        nbEssaisView = findViewById(R.id.nbEssais_view);
        lettresEssayeesView = findViewById(R.id.tried_letters_view);
        messageView = findViewById(R.id.game_result_text);
        lettreInput = findViewById(R.id.letter_view);
        btnEssayer = findViewById(R.id.try_btn);
        btnRestart = findViewById(R.id.restart_btn);
        btnQuitter = findViewById(R.id.quit_btn);

        String mot = Pendu.choisirMotAleatoire(CreateListMots.lesMots(PenduActivity.this));
        pendu = new Pendu(mot);

        // Affiche le mot masqué avec des esapces entre les tirets
        motCacheView.setText(pendu.getMotCache().toString().replaceAll("", " ").trim());
        nbEssaisView.setText("Essais restants: " + pendu.getNbEssais());

        btnEssayer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                char input = lettreInput.getText().toString().charAt(0);
                pendu.saisirLettre(input);
                String lettresActuelles = lettresEssayeesView.getText().toString();
                lettresEssayeesView.setText(lettresActuelles + " " + input + " - ");
                motCacheView.setText(pendu.getMotCache());
                nbEssaisView.setText("Essais restants : " + pendu.getNbEssais());
                lettreInput.setText("");

                if(pendu.estTermine()){
                    messageView.setVisibility(View.VISIBLE);
                    btnRestart.setVisibility(View.VISIBLE);
                    btnQuitter.setVisibility(View.VISIBLE);
                    btnEssayer.setEnabled(false);

                    SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedPreferences.edit();
                    editor.putInt("SCORE_PENDU", pendu.getScore());
                    editor.apply();

                    if(pendu.estGagne()){
                        messageView.setText("Vous avez trouvé le mot  " + pendu.getMotATrouver() + " Bien joué !");
                    }else{
                        messageView.setText("Vous avez perdu, le mot à trouver était " + pendu.getMotATrouver() + " Dommage !");
                    }
                }
            }
        });

        btnRestart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent penduActivityIntent = new Intent(PenduActivity.this, PenduActivity.class);
                startActivity(penduActivityIntent);
                finish();
            }
        });

        btnQuitter.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }

    /*@Override
    protected void onResume(){
        super.onResume();
        SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        int score = pendu.getScore();
        editor.putInt("SCORE_PENDU", score);

        // Appliquer les changements
        editor.apply();
    }*/

        /*@Override
    protected void onResume() {
        super.onResume();

        // Récupérer les SharedPreferences
        SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);

        // Récupérer le score sauvegardé, avec une valeur par défaut de 0
        int score = sharedPreferences.getInt("score", 0);
    }

    @Override
    protected void onPause() {
        super.onPause();

        // Sauvegarder le score dans SharedPreferences
        SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        // Enregistrer le score actuel
        int score = pendu.getScore();  // Utiliser la méthode getScore() pour obtenir le score actuel
        editor.putInt("score", score);

        // Appliquer les changements
        editor.apply();
    }*/

}