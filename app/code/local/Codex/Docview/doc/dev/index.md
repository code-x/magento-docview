# DocView
Mit DocView wird Dokumentation der Module an einer zentralen Stelle gesammelt und in Magento angezeigt.

[Screenshots](screenshots.md)


## Doku hinzufügen

- Damit ein Modul Doku bereitstellt muss eine index.md z.B. `app/code/local/code/doc/index.md` liegen 
- Alle index.md aller Module werden automatisch untereinander dargestellt
- Eine index.md ist dabei als Inhaltsverzeichnis eines Kapitel zu betrachten
- Die index.md enthalten somit kurze Erklärungen mit Links zu Details

### Beispiel Modul "Tolle Kundengruppen" index.md

```
# Kundengruppen
- [Wie lassen sich Zahlungen je Kundengruppe konfiguieren?](zahlungsarten.md)
- [Wie lassen sich Steuern je Kundengruppe konfiguieren?](steuer.md)
```

## Entwickler Doku

- Doku für Entwickler funktioniert genauso wie Kundendoku
- Die Doku muss allerdings im Unterordner "doc/dev" abgelegt werden: `app/code/local/code/doc/dev/index.md`
- Auch hier wird die komplette Dokumentation untereinander dargestellt
- Ich persönliche gliedere diese Doku dann nur selten in weitere Markdown-Dateien - ist ja nicht für den Kunden :-)

## ACL

Die Dokumentation eines Modules kann je Modul an ACLs geknüpft werden.
Dazu die system.xml des Modules wie folgt bearbeiten:


```
<admin>
    <docview>
        <Codex_Docview>
            <acl>
                <codex_base>
                    <docview/>
                </codex_base>
            </acl>
        </Codex_Docview>
    </docview>
</admin>`
```

Es können mehrere ACLs angegeben werden, eines muss gültig sein da der Nutzer sonst 
keinen Zugriff auf die Doku des Modules per Magento Admin hat.


## Hilfe zu Markdown

[Markdown Howto](markdown.md)
