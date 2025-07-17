package fr.iut.androidprojet.gamesActs.geography;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.List;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;
import fr.iut.androidprojet.gamesModels.geography.FlagsPays;

public class FlagsGuesserActivity extends MotherActivity {
    private List<FlagsPays> drapeauxPays;
    private int indexActuel = 0;
    private ImageView imageDrapeau;
    private TextView numDrapeau, messageView;
    private EditText editPays;
    private Button btnValider, btnRestart, btnQuitter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_flags_guesser);

        imageDrapeau = findViewById(R.id.flag_image);
        numDrapeau = findViewById(R.id.flag_number);
        editPays = findViewById(R.id.pays_view);
        btnValider = findViewById(R.id.button_valider);
        btnRestart = findViewById(R.id.restart_btn);
        btnQuitter = findViewById(R.id.quit_btn);
        messageView = findViewById(R.id.game_result_text);

        drapeauxPays = FlagsPays.initializeFlags();
        afficherDrapeau();

        btnValider.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String reponse = editPays.getText().toString().trim();
                String paysCorrect = drapeauxPays.get(indexActuel).getNom();

                if (reponse.equalsIgnoreCase(paysCorrect)) {
                    Toast.makeText(FlagsGuesserActivity.this, "Bonne réponse !", Toast.LENGTH_SHORT).show();
                    FlagsPays.incrementScore();
                } else {
                    Toast.makeText(FlagsGuesserActivity.this, "Mauvaise réponse : c'était " + paysCorrect, Toast.LENGTH_LONG).show();
                }

                indexActuel++;

                if (indexActuel < FlagsPays.getTotalDrapeaux()) {
                    afficherDrapeau();
                } else {
                    editPays.setVisibility(View.INVISIBLE);
                    btnValider.setVisibility(View.INVISIBLE);
                    btnRestart.setVisibility(View.VISIBLE);
                    btnQuitter.setVisibility(View.VISIBLE);
                    messageView.setVisibility(View.VISIBLE);
                    messageView.setText("Vous avez trouvé " + FlagsPays.getScore() + " drapeaux");

                    SharedPreferences sharedPreferences = getSharedPreferences("GameStats", MODE_PRIVATE);
                    SharedPreferences.Editor editor = sharedPreferences.edit();
                    editor.putInt("SCORE_DRAPEAUX", FlagsPays.getScore());
                    editor.apply();
                }

                editPays.setText("");
            }
        });

        btnRestart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent flagsGuesserActivityIntent = new Intent(FlagsGuesserActivity.this, FlagsGuesserActivity.class);
                startActivity(flagsGuesserActivityIntent);
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

    private void afficherDrapeau() {
        FlagsPays drapeauActuel = drapeauxPays.get(indexActuel);
        imageDrapeau.setImageResource(drapeauActuel.getIdFlag());
        numDrapeau.setText("Drapeau " + (indexActuel + 1) + "/" + FlagsPays.getTotalDrapeaux());
    }
}
