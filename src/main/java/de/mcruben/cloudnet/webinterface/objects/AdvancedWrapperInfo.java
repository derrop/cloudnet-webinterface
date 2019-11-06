package de.mcruben.cloudnet.webinterface.objects;

/*
 * Created by Mc_Ruben on 08.08.2018
 * 

 */


import de.dytanic.cloudnet.lib.network.WrapperInfo;

@lombok.ToString
@lombok.Getter
public class AdvancedWrapperInfo extends WrapperInfo {
    private double cpuUsage;
    private int usedMemory;

    public AdvancedWrapperInfo(double cpuUsage, int usedMemory, WrapperInfo wrapperInfo) {
        super(wrapperInfo.getServerId(), wrapperInfo.getHostName(), wrapperInfo.getVersion(), wrapperInfo.isReady(), wrapperInfo.getAvailableProcessors(), wrapperInfo.getStartPort(), wrapperInfo.getProcess_queue_size(), wrapperInfo.getMemory());
        this.cpuUsage = cpuUsage;
        this.usedMemory = usedMemory;
    }
}
