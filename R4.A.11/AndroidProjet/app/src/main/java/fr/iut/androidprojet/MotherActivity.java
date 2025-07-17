package fr.iut.androidprojet;

import android.content.res.Configuration;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

public class MotherActivity extends AppCompatActivity {
    @Override
    public void onConfigurationChanged(@NonNull Configuration newConfig) {
        super.onConfigurationChanged(newConfig);

        // Si tu veux adapter l’UI à la nouvelle orientation :
        if (newConfig.orientation == Configuration.ORIENTATION_LANDSCAPE) {
            // mode paysage
        } else if (newConfig.orientation == Configuration.ORIENTATION_PORTRAIT) {
            // mode portrait
        }
    }
}
