# ACL

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