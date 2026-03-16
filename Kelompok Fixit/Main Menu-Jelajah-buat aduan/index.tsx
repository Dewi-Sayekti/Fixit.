import { useState } from "react";
import { ChevronDown } from "lucide-react";

export default function Index() {
  const [activeTab, setActiveTab] = useState<"jelajah" | "aduan">("jelajah");

  return (
    <div className="min-h-screen bg-gradient-to-b from-[#2a3f5f] to-[#1a2744] flex items-center justify-center p-4">
      <div className="w-full max-w-[412px] h-[892px] relative overflow-hidden rounded-[32px] border-[8px] border-[#CAC4D0] bg-gradient-to-b from-[#213158] to-[#213158] shadow-2xl flex flex-col">
        {/* Status Bar */}
        <div className="flex justify-between items-end px-6 pt-2.5 pb-2.5 h-[52px] flex-shrink-0">
          <span className="text-[#1D1B20] text-sm font-normal">9:30</span>
          <div className="flex items-center gap-2">
            <div className="w-5 h-5 rounded-full bg-[#1D1B20] opacity-10" />
            <svg width="24" height="16" viewBox="0 0 24 16" fill="none">
              <path d="M21 0h3v16h-3V0zm-9 0h3v16h-3V0zm-9 0h3v16H3V0z" fill="#1D1B20" fillOpacity="0.3" />
            </svg>
            <svg width="13" height="15" viewBox="0 0 13 15" fill="none">
              <rect x="0.5" y="1.5" width="10" height="13" rx="1.5" stroke="#1D1B20" strokeOpacity="0.3" />
              <rect x="0.5" y="7" width="10" height="7.5" fill="#1D1B20" />
            </svg>
          </div>
        </div>

        {/* Header */}
        <div className="px-6 mt-4 flex justify-between items-start flex-shrink-0">
          <h1 className="text-white font-bold text-[26px] tracking-[0.26px] leading-[18px]">
            FIXIT.
          </h1>
          <div className="flex flex-col items-end gap-3">
            <div className="flex items-center gap-2">
              <div className="px-2 py-0.5 bg-white rounded-[11px]">
                <span className="text-[#213158] text-sm font-normal tracking-[0.14px]">
                  dosen
                </span>
              </div>
            </div>
            <div className="text-white text-base font-normal tracking-[0.16px] leading-[18px]">
              mirko
            </div>
          </div>
        </div>

        {/* Area and Floor Selection */}
        <div className="px-6 mt-6 flex justify-between items-center flex-shrink-0">
          <span className="text-white text-[31px] font-normal tracking-[0.31px] leading-[18px]">
            Area
          </span>
          <button className="px-3 py-2 border border-white rounded-[35px] flex items-center gap-1 min-w-[106px] justify-between">
            <span className="text-white text-sm font-normal tracking-[0.14px] ml-1">
              Lantai 1
            </span>
            <ChevronDown className="w-[15px] h-[15px] text-white" strokeWidth={2.5} />
          </button>
        </div>

        {/* Scrollable Content Area */}
        <div className="flex-1 overflow-y-auto px-[22px] mt-6 pb-[100px]">
          {/* Main Content Card */}
          <div className="bg-white/[0.99] rounded-[19px] p-[13px] shadow-lg mb-5">
            <div className="space-y-[14px]">
              {/* Image Upload Area */}
              <div className="w-full h-[400px] rounded-[18px] border border-[#213158] flex flex-col items-center justify-center bg-white">
                <div className="text-center">
                  <p className="text-[#213158] text-xl font-normal tracking-[0.2px] leading-6">
                    bukti objek
                  </p>
                  <p className="text-[#213158] text-xl font-normal tracking-[0.2px] leading-6">
                    bermasalah
                  </p>
                </div>
              </div>

              {/* Description Input */}
              <div className="w-full h-[71px] rounded-[25px] border border-[#213158] flex items-center justify-center bg-white">
                <span className="text-[#213158]/63 text-xl font-normal tracking-[0.2px] leading-[18px]">
                  Keterangan
                </span>
              </div>
            </div>
          </div>

          {/* Location Card */}
          <div className="bg-white rounded-[19px] px-6 py-6 flex items-center justify-between min-h-[115px]">
            <span className="text-[#213158] text-[26px] font-normal tracking-[0.26px] leading-7">
              Lobby utama
            </span>
            <button className="px-[15px] py-[14px] border border-[#213158] rounded-[35px] h-[44px] flex items-center justify-center whitespace-nowrap">
              <span className="text-[#213158] text-xl font-normal tracking-[0.2px] leading-[18px]">
                buat aduan
              </span>
            </button>
          </div>
        </div>

        {/* Bottom Navigation */}
        <div className="absolute bottom-0 left-0 right-0 h-[74px] bg-white/10 border-t border-white backdrop-blur-sm rounded-t-[26px] flex-shrink-0">
          <div className="flex justify-around items-center h-full px-12 pt-2 relative">
            <button
              onClick={() => setActiveTab("jelajah")}
              className="flex flex-col items-center gap-1 relative"
            >
              <span className="text-white text-[23px] font-normal tracking-[0.23px] leading-[18px]">
                jelajah
              </span>
              {activeTab === "jelajah" && (
                <div className="w-[52px] h-[7px] bg-white rounded-[9px] absolute top-[28px]" />
              )}
            </button>
            <button
              onClick={() => setActiveTab("aduan")}
              className="flex flex-col items-center gap-1 relative"
            >
              <span className="text-white text-[23px] font-normal tracking-[0.23px] leading-[18px]">
                aduan
              </span>
              {activeTab === "aduan" && (
                <div className="w-[52px] h-[7px] bg-white rounded-[9px] absolute top-[28px]" />
              )}
            </button>
          </div>
          {/* Navigation Handle */}
          <div className="absolute bottom-2.5 left-1/2 -translate-x-1/2 w-[108px] h-1 bg-[#1D1B20] rounded-[12px]" />
        </div>
      </div>
    </div>
  );
}
