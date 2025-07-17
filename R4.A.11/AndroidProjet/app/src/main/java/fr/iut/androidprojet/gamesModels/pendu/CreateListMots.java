package fr.iut.androidprojet.gamesModels.pendu;

import android.content.Context;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

public class CreateListMots {
    public static ArrayList<String> lesMots(Context context) {
        String ligne, mot;
        ArrayList<String> resultat = new ArrayList<>();
        try {
            InputStream is = context.getAssets().open("mots.txt");
            BufferedReader br = new BufferedReader(new InputStreamReader(is));
            while ((ligne = br.readLine()) != null) {
                mot = ligne;
                resultat.add(mot.trim());
            }
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return resultat;
    }
}
